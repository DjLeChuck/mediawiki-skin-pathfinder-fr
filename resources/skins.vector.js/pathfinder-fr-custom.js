module.exports = function () {
  // Select de changement de namespace
  var nsSwitch = document.querySelector('[data-switch-ns]');
  if (nsSwitch) {
    nsSwitch.addEventListener('change', function () {
      location.href = this.value;
    });
  }

  // Suppression des éléments vides
  document.querySelectorAll('.hideifempty').forEach(hideIfEmpty);

  // Encart Dieu tech
  document.querySelectorAll('[data-dieutech]').forEach(dieuTechCard);

  // Élément titre dynamique
  document.querySelectorAll('.titre').forEach(titre);

  // Toggle des tableaux
  document.querySelectorAll('table.toggle caption').forEach(toggleTable);

  // Pré-requis des dons
  $('tr.donprérequis0, tr.donprérequis1, tr.donprérequis2').hide();
  const donPrincipal = $('tr.donprincipal');
  donPrincipal.bind('click', togglePrereq);
  donPrincipal.each(addPrereqIconIfNeeded);

  const donPrerequis0 = $('tr.donprérequis0');
  donPrerequis0.bind('click', togglePrereq0);
  donPrerequis0.each(addPrereqIconIfNeeded0);

  const donPrerequis1 = $('tr.donprérequis1');
  donPrerequis1.bind('click', togglePrereq1);
  donPrerequis1.each(addPrereqIconIfNeeded1);

  $('tr.donprérequis2').each(addPrereqIconIfNeeded2);

  // Tableaux filtrables
  $('table.filtrable').each(makeFiltrable);
};

function hideIfEmpty(elem) {
  if ('' === elem.innerText.trim()) {
    elem.remove();
  } else if (elem.dataset.prefixe) {
    elem.innerHTML = elem.dataset.prefixe + elem.innerHTML;
    delete elem.dataset.prefixe;
  }
}

function dieuTechCard(el) {
  const image = el.querySelector('[data-image]');
  if ('' === image.dataset.image.trim()) {
    el.querySelector('#symbole').innerHTML = '<i>Aucun symbole connu</i>';
  }

  const highlightMap = {
    'Loyal Bon': ['LB', 'NB', 'LN'],
    'Loyal Neutre': ['LB', 'LN', 'N', 'LM'],
    'Loyal Mauvais': ['LN', 'LM', 'NM'],
    'Neutre Bon': ['LB', 'NB', 'CB', 'N'],
    'Neutre': ['NB', 'LN', 'N', 'CN', 'NM'],
    'Neutre Mauvais': ['N', 'LM', 'NM', 'CM'],
    'Chaotique Bon': ['NB', 'CB', 'CN'],
    'Chaotique Neutre': ['CB', 'N', 'CN', 'CM'],
    'Chaotique Mauvais': ['CN', 'NM', 'CM'],
  };

  const align = el.querySelector('[data-alignment]').dataset?.alignment ?? '';

  (highlightMap[align] ?? []).forEach(align => highlight(align));
}

function highlight(value) {
  const el = document.getElementById(value);
  if (!el) {
    return;
  }

  el.classList.remove('Non');
  el.classList.add('Oui');
}

function titre(elem) {
  if (elem.innerText.trim() === 'Non')
    elem.remove();
  else if (elem.innerText.trim() === 'Oui') {
    elem.innerText = elem.dataset.prefixe;
  }
}

function toggleTable(elem) {
  elem.addEventListener('click', () => {
    elem.closest('table').querySelectorAll('tr').forEach(tr => tr.classList.toggle('cache'));
  });
}

const sortDown = '/resources/src/jquery.tablesorter.styles/images/sort_down.svg';
const sortUp = '/resources/src/jquery.tablesorter.styles/images/sort_up.svg';

function togglePrereq() {
  let nodeImg = $(this).find('img');
  if (nodeImg.attr('src') === sortDown) {
    nodeImg.attr('src', sortUp);
  } else {
    nodeImg.attr('src', sortDown);
  }

  let node = $(this).next();
  while (node.length > 0 && node.hasClass('donprérequis0') || node.hasClass('donprérequis1') || node.hasClass('donprérequis2')) {
    node.toggle();
    if (node.hasClass('donprérequis1') || node.hasClass('donprérequis2')) {
      node.toggle();
    }

    node = node.next();
  }
}

function togglePrereq0() {
  let nodeImg = $(this).find('img');
  if (nodeImg.attr('src') === sortDown) {
    nodeImg.attr('src', sortUp);
  } else {
    nodeImg.attr('src', sortDown);
  }

  let node = $(this).next();
  while (node.length > 0 && node.hasClass('donprérequis1') || node.hasClass('donprérequis2')) {
    node.toggle();
    if (node.hasClass('donprérequis2')) {
      node.toggle();
    }

    node = node.next();
  }
}

function togglePrereq1() {
  let nodeImg = $(this).find('img');
  if (nodeImg.attr('src') === sortDown) {
    nodeImg.attr('src', sortUp);
  } else {
    nodeImg.attr('src', sortDown);
  }

  let node = $(this).next();
  while (node.length > 0 && node.hasClass('donprérequis2')) {
    node.toggle();
    node = node.next();
  }
}

function addDonIcon(el) {
  const icon = document.createElement('img');
  icon.src = sortDown;
  icon.style = 'float:right;margin-top: 3px;';
  icon.title = 'Cliquez pour afficher les dons qui découlent de celui-ci.';
  $(el).children('td').first().append($(icon));
}

function addPrereqIconIfNeeded() {
  const next = $(this).next();

  if (next.length > 0 && next.hasClass('donprérequis0')) {
    addDonIcon(this);
  }
}

function addPrereqIconIfNeeded0() {
  const next = $(this).next();

  if (next.length > 0 && next.hasClass('donprérequis1')) {
    addDonIcon(this);
  }
}

function addPrereqIconIfNeeded1() {
  const next = $(this).next();

  if (next.length > 0 && next.hasClass('donprérequis2')) {
    addDonIcon(this);
  }

  if (next.length > 0 && next.hasClass('donprérequis0')) {
    $(this).children('td').css('border-bottom', '1px solid black');
  }
}

function addPrereqIconIfNeeded2() {
  const next = $(this).next();

  if (next.length > 0 && next.hasClass('donprérequis0') || next.hasClass('donprérequis1')) {
    $(this).children('td').css('border-bottom', '1px solid black');
  }
}

function makeFiltrable() {
  const table = $(this);
  const rows = table.find('tr');

  if (rows.length < 2) {
    return;
  }

  const firstRow = rows.first();
  const cells = firstRow.children('td,th');
  table.get()[0].filters = [];
  cells.each(function (idx) {
    var filterLogo = $('<img height="12px" />');
    filterLogo.attr('src', '/skins/PathfinderFR/resources/common/images/filter.png');
    filterLogo.attr('title', 'Cliquez ici pour filtrer les données');
    filterLogo.css('padding', '0');
    filterLogo.click(doFilter(idx, filterLogo, table));
    $(this).prepend(filterLogo);
    table.get()[0].filters.push(null);
  });
}

function doFilter(nCol, logo, table) {
  return function () {
    const filter = prompt('Entrez le filtre à appliquer.\nLaisser le cadre vide pour tout afficher; utilisez \'mot1|mot2\' pour un choix multiple.', '').trim();

    if (filter === '') {
      table.get()[0].filters[nCol] = null;
      logo.css('background-color', '');
      logo.attr('title', 'Filtre actuel : aucun - cliquez pour changer le filtre');
    } else {
      table.get()[0].filters[nCol] = new RegExp(filter.trim(), 'i');
      logo.css('background-color', 'yellow');
      logo.attr('title', 'Filtre actuel : ' + (filter === '' ? 'aucun' : filter)
        + ' - cliquez pour changer le filtre');
    }

    applyFilter(table);
  };
}

function applyFilter(table) {
  const rows = table.find('tr').filter(function (idx) {
    return idx > 0 && $(this).children('th').length === 0;
  });

  rows.each(function () {
    const keep = mustKeep(this, table.get()[0].filters);
    $(this).css('display', keep ? 'table-row' : 'none');
  });
}

function mustKeep(row, filters) {
  const cells = $(row).children('td');
  const nCols = filters.length;
  let keep = true;
  let iCol = 0;

  while (keep && iCol < nCols) {
    keep = filters[iCol] === null ||
      cells.eq(iCol).html().match(filters[iCol]) != null;
    iCol++;
  }

  return keep;
}
