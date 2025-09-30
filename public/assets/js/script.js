

$(document).ready(function(){
    $('.feedback-slider').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        items: 1,
        autoplay: true,
        navText: ["<i class = 'fas fa-arrow-left'></i>", "<i class = 'fas fa-arrow-right'></i>"]
    });

    // stop animation on resize
    let resizeTimer;
    $(window).resize(function(){
        $(document.body).addClass('resize-animation-stopper');
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            $(document.body).removeClass('resize-animation-stopper');
        }, 400);
    });

    $('.navbar-show-btn').click(function(){
        $('.navbar-box').addClass('navbar-box-show');
    });

    $('.navbar-hide-btn').click(function(){
        $('.navbar-box').removeClass("navbar-box-show");
    })
});

// ############################################
let loadMoreBtn = document.querySelector('#load-more');
let currentItem = 3;

loadMoreBtn.onclick = () =>{
    let boxes = [...document.querySelectorAll('.sc-services .services-list a')];
    for (var i = currentItem; i < currentItem + 3; i++){
        boxes[i].style.display = 'flex';
    }
    currentItem += 3;
    
    if(currentItem >= boxes.length){
        loadMoreBtn.style.display = 'none';
    }
}

// ##################### Pop Up #######################
const div = document.querySelector(".pop_up"),
overlay = document.querySelector(".overlay"),
showBtn = document.querySelector(".show-modal");

showBtn.addEventListener("click", () => div.classList.add("active"));

overlay.addEventListener("click", () =>
    div.classList.remove("active")
);

