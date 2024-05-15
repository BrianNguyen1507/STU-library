
document.addEventListener('DOMContentLoaded', function () {
    var detailLinks = document.querySelectorAll('.detail-link');
    detailLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            var documentId = link.getAttribute('data-id');
            window.location.href = 'services/dataFetching/fetchingDetail.php?id=' + documentId;
        });
    });
});