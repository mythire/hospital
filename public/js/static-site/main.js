(function($){"use strict";$('.mean-menu').meanmenu({meanScreenWidth:"1199"});$(window).on('scroll',function(){if($(this).scrollTop()>120){$('.navbar-area').addClass("is-sticky");}
else{$('.navbar-area').removeClass("is-sticky");}});$(".others-option-for-responsive .dot-menu").on("click",function(){$(".others-option-for-responsive .container .container").toggleClass("active");});$(".others-option .search-icon i").on("click",function(){$(".search-overlay").toggleClass("search-overlay-active");});$(".search-overlay-close").on("click",function(){$(".search-overlay").removeClass("search-overlay-active");});var tooltipTriggerList=[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList=tooltipTriggerList.map(function(tooltipTriggerEl){return new bootstrap.Tooltip(tooltipTriggerEl)});$('.popup-image').magnificPopup({type:'image',gallery:{enabled:true}});$('.popup-video').magnificPopup({disableOn:320,type:'iframe',mainClass:'mfp-fade',removalDelay:160,preloader:false,fixedContentPos:false});$('.odometer').appear(function(e){var odo=$(".odometer");odo.each(function(){var countNumber=$(this).attr("data-count");$(this).html(countNumber);});});var carouselEl=$('.startup-works-slides');carouselEl.owlCarousel({items:1,loop:true,margin:30,nav:false,dots:false,autoplay:true,autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"]});$(".custom-owl-prev").click(function(){carouselEl.trigger('next.owl.carousel');});$(".custom-owl-next").click(function(){carouselEl.trigger('prev.owl.carousel');});$('.furniture-banner-slides').owlCarousel({items:1,nav:false,loop:true,margin:30,dots:true,autoplay:true,animateIn:'fadeIn',animateOut:'fadeOut',autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"]});$('.testimonials-slides').owlCarousel({items:1,nav:true,loop:true,margin:30,dots:false,autoplay:true,animateIn:'fadeIn',animateOut:'fadeOut',autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"]});$('.startup-testimonials-slides').owlCarousel({items:1,nav:true,loop:true,margin:30,dots:false,autoplay:true,animateIn:'fadeIn',animateOut:'fadeOut',autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"]});$('.saas-testimonials-slides').owlCarousel({nav:true,loop:true,margin:30,dots:false,autoplay:true,autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"],responsive:{0:{items:1},576:{items:1},768:{items:2},992:{items:2}}});$('.partner-slides').owlCarousel({nav:false,loop:true,margin:30,dots:false,autoplay:true,autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"],responsive:{0:{items:2},576:{items:3},768:{items:4},992:{items:5},1200:{items:6}}});$('.screenshot-slides').owlCarousel({nav:true,loop:true,dots:false,center:true,autoplay:true,autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"],responsive:{0:{items:1},576:{items:2},768:{items:3},992:{items:5}}});$(function(){$('.shorting').mixItUp();});$('.marketing-testimonials-slides').owlCarousel({items:1,nav:true,loop:true,margin:30,dots:false,autoplay:true,animateIn:'fadeIn',animateOut:'fadeOut',autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"]});$('.categories-slides').owlCarousel({nav:true,loop:true,margin:30,dots:false,autoplay:true,autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"],responsive:{0:{items:1},576:{items:2},768:{items:2},992:{items:4}}});$('.instagram-slides').owlCarousel({nav:false,loop:true,dots:false,autoplay:true,autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"],responsive:{0:{items:2},576:{items:3},768:{items:5},992:{items:8}}});$('.works-slides-style-one').owlCarousel({nav:true,loop:true,margin:30,dots:false,autoplay:true,autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"],responsive:{0:{items:1},576:{items:2},768:{items:2},992:{items:2}}});$('.works-slides-style-two').owlCarousel({nav:true,loop:true,margin:30,dots:true,autoplay:true,autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"],responsive:{0:{items:1},576:{items:2},768:{items:2},992:{items:3}}});$('.portfolio-details-slides').owlCarousel({nav:true,loop:true,margin:30,dots:false,autoplay:true,autoplayHoverPause:true,navText:["<i class='flaticon-left-arrow'></i>","<i class='flaticon-right-arrow'></i>"],responsive:{0:{items:1},576:{items:2},768:{items:2},992:{items:2}}});$('.jarallax').jarallax({speed:0.5,imgHeight:768,imgWidth:1366,});$('.input-counter').each(function(){var spinner=jQuery(this),input=spinner.find('input[type="text"]'),btnUp=spinner.find('.plus-btn'),btnDown=spinner.find('.minus-btn'),min=input.attr('min'),max=input.attr('max');btnUp.on('click',function(){var oldValue=parseFloat(input.val());if(oldValue>=max){var newVal=oldValue;}else{var newVal=oldValue+1;}
spinner.find("input").val(newVal);spinner.find("input").trigger("change");});btnDown.on('click',function(){var oldValue=parseFloat(input.val());if(oldValue<=min){var newVal=oldValue;}else{var newVal=oldValue-1;}
spinner.find("input").val(newVal);spinner.find("input").trigger("change");});});$(".js-range-of-price").ionRangeSlider({type:"double",drag_interval:true,min_interval:null,max_interval:null});$('.showmore-box').showMoreItems({startNum:6,afterNum:3,moreText:'Load More',noMoreText:'No More'});$('.showmore-box2').showMoreItems({startNum:6,afterNum:4,moreText:'Load More',noMoreText:'No More'});function makeTimer(){var endTime=new Date("September 20, 2021 17:00:00 PDT");var endTime=(Date.parse(endTime))/1000;var now=new Date();var now=(Date.parse(now)/1000);var timeLeft=endTime-now;var days=Math.floor(timeLeft/86400);var hours=Math.floor((timeLeft-(days*86400))/3600);var minutes=Math.floor((timeLeft-(days*86400)-(hours*3600))/60);var seconds=Math.floor((timeLeft-(days*86400)-(hours*3600)-(minutes*60)));if(hours<"10"){hours="0"+hours;}
if(minutes<"10"){minutes="0"+minutes;}
if(seconds<"10"){seconds="0"+seconds;}
$("#days").html(days+"<span>Days</span>");$("#hours").html(hours+"<span>Hours</span>");$("#minutes").html(minutes+"<span>Minutes</span>");$("#seconds").html(seconds+"<span>Seconds</span>");}
setInterval(function(){makeTimer();},0);var TxtType=function(el,toRotate,period){this.toRotate=toRotate;this.el=el;this.loopNum=0;this.period=parseInt(period,10)||2000;this.txt='';this.tick();this.isDeleting=false;};TxtType.prototype.tick=function(){var i=this.loopNum%this.toRotate.length;var fullTxt=this.toRotate[i];if(this.isDeleting){this.txt=fullTxt.substring(0,this.txt.length-1);}else{this.txt=fullTxt.substring(0,this.txt.length+1);}
this.el.innerHTML='<span class="wrap">'+this.txt+'</span>';var that=this;var delta=200-Math.random()*100;if(this.isDeleting){delta/=2;}
if(!this.isDeleting&&this.txt===fullTxt){delta=this.period;this.isDeleting=true;}else if(this.isDeleting&&this.txt===''){this.isDeleting=false;this.loopNum++;delta=500;}
setTimeout(function(){that.tick();},delta);};window.onload=function(){var elements=document.getElementsByClassName('typewrite');for(var i=0;i<elements.length;i++){var toRotate=elements[i].getAttribute('data-type');var period=elements[i].getAttribute('data-period');if(toRotate){new TxtType(elements[i],JSON.parse(toRotate),period);}}
var css=document.createElement("style");css.type="text/css";css.innerHTML=".typewrite > .wrap { border-right: 0.08em solid #000000}";document.body.appendChild(css);};$(".newsletter-form").validator().on("submit",function(event){if(event.isDefaultPrevented()){formErrorSub();submitMSGSub(false,"Please enter your email correctly.");}else{event.preventDefault();}});function callbackFunction(resp){if(resp.result==="success"){formSuccessSub();}
else{formErrorSub();}}
function formSuccessSub(){$(".newsletter-form")[0].reset();submitMSGSub(true,"Thank you for subscribing!");setTimeout(function(){$("#validator-newsletter").addClass('hide');},4000)}
function formErrorSub(){$(".newsletter-form").addClass("animated shake");setTimeout(function(){$(".newsletter-form").removeClass("animated shake");},1000)}
function submitMSGSub(valid,msg){if(valid){var msgClasses="validation-success";}else{var msgClasses="validation-danger";}
$("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);}
$(".newsletter-form").ajaxChimp({url:"https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9",callback:callbackFunction});$(function(){$(window).on('scroll',function(){var scrolled=$(window).scrollTop();if(scrolled>600)$('.go-top').addClass('active');if(scrolled<600)$('.go-top').removeClass('active');});$('.go-top').on('click',function(){$("html, body").animate({scrollTop:"0"},500);});});}(jQuery));