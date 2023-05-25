/* eslint-disable no-undef */
/* eslint-disable func-names */
// eslint-disable-next-line func-names
(function($) {
  const helper = {
    // custom helper function for debounce - how to work see https://codepen.io/Hyubert/pen/abZmXjm
    /**
     * Debounce
     * need for once call function
     *
     * @param { function } - callback function
     * @param { number } - timeout time (ms)
     * @return { function }
     */
    debounce(func, timeout) {
      let timeoutID;
      // eslint-disable-next-line no-param-reassign
      timeout = timeout || 200;
      return function() {
        const scope = this;
        // eslint-disable-next-line prefer-rest-params
        const args = arguments;
        clearTimeout(timeoutID);
        timeoutID = setTimeout(function() {
          func.apply(scope, Array.prototype.slice.call(args));
        }, timeout);
      };
    },
    /**
     * Helper if element exist then call function
     */
    isElementExist(_el, _cb, _argCb) {
      const elem = document.querySelector(_el);
      if (document.body.contains(elem)) {
        try {
          if (arguments.length <= 2) {
            _cb();
          } else {
            _cb(..._argCb);
          }
        } catch (e) {
          // eslint-disable-next-line no-console
          console.log(e);
        }
      }
    },

    /**
     *  viewportCheckerAnimate function
     *
     * @param whatElement - element name
     * @param whatClassAdded - class name if element is in viewport
     * @param classAfterAnimate - class name after element animates
     */
    viewportCheckerAnimate(whatElement, whatClassAdded, classAfterAnimate) {
      jQuery(whatElement)
        .addClass('a-hidden')
        .viewportChecker({
          classToRemove: 'a-hidden',
          classToAdd: `animated ${whatClassAdded}`,
          offset: 10,
          callbackFunction(elem) {
            if (classAfterAnimate) {
              elem.on('animationend', () => {
                elem.addClass('animation-end');
              });
            }
          }
        });
    },
    // helpler windowResize
    windowResize(functName) {
      const self = this;
      $(window).on('resize orientationchange', self.debounce(functName, 200));
    },
    /**
     * Init slick slider only on mobile device
     *
     * @param {DOM} $slider
     * @param {array} option - slick slider option
     */
    mobileSlider($slider, option) {
      if (window.matchMedia('(max-width: 768px)').matches) {
        if (!$slider.hasClass('slick-initialized')) {
          $slider.slick(option);
        }
      } else if ($slider.hasClass('slick-initialized')) {
        $slider.slick('unslick');
      }
    },
    /**
     * Init slick slider only on desktop device
     *
     * @param {DOM} $slider
     * @param {array} option - slick slider option
     */
    desktopSlider($slider, option) {
      if (window.matchMedia('(min-width: 769px)').matches) {
        if (!$slider.hasClass('slick-initialized')) {
          $slider.slick(option);
        }
      } else if ($slider.hasClass('slick-initialized')) {
        $slider.slick('unslick');
      }
    }
  };

  const theme = {
    /**
     * Main init function
     */
    init() {
      this.plugins(); // Init all plugins
      this.initHeight(); // Init Height
      this.bindEvents(); // Bind all events
      this.initAnimations(); // Init all animations
    },

    /**
     * Init External Plugins
     */
    plugins() {},

    /**
     * init height
     */
    initHeight() {
      // Toggle header
      $('.hamburger').on('click', function() {
        $('.header').toggleClass('is-opened');
      });
      $('.menu-item-has-children > a').on('touchstart click', function() {
          if (window.matchMedia('(max-width: 1023px)').matches) {
            $(this).toggleClass('is-opened')
            $(this)
              .next()
              .toggleClass('is-active');
          }
          return false;
      });
      // add header height value
      $(window).on('load resize', function() {
        const headerHeight =
          $('header').outerHeight();
        document.documentElement.style.setProperty(
          '--header-height',
          `${headerHeight}px`
        );
      });
    },

    /**
     * Bind all events here
     *
     */
    bindEvents() {
      const self = this;
      /** * Run on Document Ready ** */
      $(document).on('ready', function() {
        self.smoothScrollLinks();

        helper.isElementExist(
          '.cards-slider__carousel',
          theme.initCardsCarousel
        );
        helper.isElementExist('.testimonials', theme.initTestimonials);
        helper.isElementExist('.testimonial-slider',theme.initTestimonialSlider);
        helper.isElementExist('.podcasts-items', theme.initPodcasts);
        helper.isElementExist('.practice-areas__items', theme.initPracticeareas);
        $(window).on('resize', function() {
          helper.isElementExist('.podcasts-items', theme.initPodcasts);
          helper.isElementExist('.practice-areas__items', theme.initPracticeareas);
        });

        // accordion
        $('.accordion-item__heading').on('click', function() {
          $(this).toggleClass('active');
          $(this)
            .next()
            .slideToggle('normal');
        });
        helper.isElementExist(
          '.posts-slider__carousel',
          theme.initPostCarousel
        );

        // Show all cards on click
        $('.btn-show-more').on('click', function() {
          const $cards = $(this).closest('.cards-slider');
          $cards.addClass('is-show');
          $(this)
            .closest('.cards-slider__showmore')
            .hide();
        });
      });
      /** * Run on Window Load ** */
      $(window).on('scroll', function() {
        if ($(window).scrollTop() >= 50)
          $('.header').addClass('header--sticky');
        else $('.header').removeClass('header--sticky');
      });
    },

    /**
     * init scroll revealing animations function
     */
    initAnimations() {
      helper.viewportCheckerAnimate('.a-up', 'fadeInUp', true);
      helper.viewportCheckerAnimate('.a-down', 'fadeInDown');
      helper.viewportCheckerAnimate('.a-left', 'fadeInLeft');
      helper.viewportCheckerAnimate('.a-right', 'fadeInRight');
      helper.viewportCheckerAnimate('.a-op', 'fade');
    },

    /**
     * Smooth Scroll link
     */
    smoothScrollLinks() {
      $('a[href^="#"').on('click touchstart', function() {
        const target = $(this).attr('href');
        if (target !== '#' && $(target).length > 0) {
          const offset = $(target).offset().top - $('header').outerHeight();
          $('html, body').animate(
            {
              scrollTop: offset
            },
            500
          );
        }
        return false;
      });
    },
    /**
     * init cards carousel
     */
    initCardsCarousel() {
      const option = {
        arrows: false,
        dots: false,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 1000
      };
      const $slider = $('.cards-slider__carousel');
      helper.desktopSlider($slider, option);
      helper.windowResize(theme.initCardsCarousel);
    },

    /**
     * init Podcasts
     */
    initPracticeareas() {
      helper.mobileSlider($('.practice-areas__items'), {
        slideToScroll: 1,
        slideToShow: 1,
        centerMode: true,
        centerPadding: '10%',
      })
    },
    /**
     * init Podcasts
     */

    initPodcasts() {
      console.log(1);
        helper.mobileSlider($('.podcasts-items'), {
          slideToScroll: 1,
          slideToShow: 1,
          centerMode: true,
          centerPadding: '5%',
        })
    },

    /**
     * init testimonials
     */
    initTestimonialSlider() {
      $('.testimonial-slider__items').slick({
        slideToShow: 1,
        slideToScroll: 1,
        centerMode: true,
        centerPadding: '28%',
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slideToScroll: 1,
              slideToShow: 1,
              centerMode: true,
              centerPadding: '5%'
            }
          },
          {
            breakpoint: 1024,
            settings: {
              slideToScroll: 1,
              slideToShow: 1,
              centerMode: true,
              centerPadding: '15%'
            }
          }
        ]
      });
    },

    initTestimonials() {
      // init mobile slider
      $('.testimonials-mobile').slick({
        arrows: false,
        dots: false,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000
      });
      // init desktop main slider
      const $mainSlider = $('.testimonials-main-slider').slick({
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        fade: true,
        asNavFor: '.testimonials-next-slider'
      });
      // init desktop next slider
      $('.testimonials-next-slider').slick({
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        fade: true,
        asNavFor: '.testimonials-main-slider'
      });
      // show next slide
      $('.testimonial-next').on('click', function() {
        $mainSlider.slick('slickNext');
      });
    },
    /**
     * init post carousel
     */
    initPostCarousel() {
      $('.posts-slider__carousel').each(function() {
        const $this = $(this);
        const $parent = $this.closest('.posts-slider');
        $this.on('init reInit afterChange', function(
          event,
          slick,
          currentSlide,
          nextSlide
        ) {
          // no dots -> no slides
          if (!slick.$dots) {
            return;
          }

          // currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
          const i = (currentSlide || 0) + 1;
          // use dots to get some count information
          $('.slider-pagination', $parent).text(
            `${i}/${slick.$dots[0].children.length}`
          );
        });
        $this.slick({
          arrows: false,
          dots: true,
          autoplay: true,
          autoplaySpeed: 2000,
          speed: 1000,
          variableWidth: true
        });
        $('.slider-next').on('click', function() {
          $this.slick('slickNext');
        });
      });
    }
  };

  // Initialize Theme
  theme.init();
})(jQuery);
