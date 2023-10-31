$(document).ready(function () {
  $("#dataTable").DataTable({
    search: {
      caseInsensitive: true, // Sesuaikan dengan preferensi Anda
      regex: true,
      smart: false,
    },
  });
});
