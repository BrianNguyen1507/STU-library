document.addEventListener('DOMContentLoaded', function() {
  
    var scrollToBestSellingItemsBtn = document.getElementById('scrollToBestSellingItems');
    scrollToBestSellingItemsBtn.addEventListener('click', function(event) {
        event.preventDefault();
        var targetSection = document.getElementById('best-items'); 
        targetSection.scrollIntoView({ behavior: "smooth" }); 
    });
});
