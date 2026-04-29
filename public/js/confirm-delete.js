(function () {
  const modal = document.getElementById('confirmDeleteModal');
  if (!modal) return;
  const confirmBtn = document.getElementById('confirmDeleteBtn');
  const modalBody = document.getElementById('confirmDeleteModalBody');
  let pendingForm = null;

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-confirm-delete]');
    if (!btn) return;
    e.preventDefault();
    pendingForm = document.getElementById(btn.dataset.confirmDelete);
    modalBody.textContent = btn.dataset.confirmMessage || modalBody.textContent;
    new bootstrap.Modal(modal).show();
  });

  confirmBtn.addEventListener('click', function () {
    if (pendingForm) pendingForm.submit();
  });
})();
