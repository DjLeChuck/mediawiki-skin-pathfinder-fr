module.exports = function () {
  var nsSwitch = document.querySelector('[data-switch-ns]');
  if (nsSwitch) {
    nsSwitch.addEventListener('change', function () {
      location.href = this.value;
    });
  }
};
