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
          $(this).toggleClass('is-opened');
          $(this)
            .next()
            .toggleClass('is-active');
          return false;
        }
      });
      // add header height value
      $(window).on('load resize', function() {
        const headerHeight = $('header').outerHeight();
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
        helper.isElementExist(
          '.testimonial-slider',
          theme.initTestimonialSlider
        );
        helper.isElementExist('.podcasts-items', theme.initPodcasts);
        helper.isElementExist(
          '.practice-areas__items',
          theme.initPracticeareas
        );
        helper.isElementExist('.accordion', theme.initAccordion);

        helper.isElementExist('.podcasts-grid', theme.initPodcasts);

        $(window).on('resize', function() {
          helper.isElementExist('.podcasts-items', theme.initPodcasts);
          helper.isElementExist(
            '.practice-areas__items',
            theme.initPracticeareas
          );
        });

        helper.isElementExist(
          '.posts-slider__carousel',
          theme.initPostCarousel
        );
        helper.isElementExist('.section-archive__posts', theme.initCPT);
        helper.isElementExist(
          '.attorney-details__sidebar',
          theme.initAttorneySidebar
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
        centerPadding: '10%'
      });
    },
    /**
     * init Podcasts
     */

    initPodcasts() {
      helper.mobileSlider($('.podcasts-items'), {
        slideToScroll: 1,
        slideToShow: 1,
        centerMode: true,
        centerPadding: '5%'
      });
    },

    /**
     * init Accordion
     */
    initAccordion() {
      $('.accordion-header').on('click', function() {
        const $accordion = $(this).closest('.accordion');
        $(this).toggleClass('active');
        $('.accordion-body', $accordion).slideToggle();
      });
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
          currentSlide
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
    },
    /**
     * init archive page
     */

    initCPT() {
      const $grid = $('.section-archive__posts');
      const $loadmore = $('.cpt-load-more');
      const $loadmoreBtn = $('.cpt-load-more-btn');

      // ajax cpt function
      function ajaxCPT(loadmore = false) {
        const paged = $grid.attr('data-paged');
        const postsPerPage = $grid.attr('data-posts-per-page');
        const postType = $grid.attr('data-post-type');
        const cat = $grid.attr('data-cat');
        const caseCat = $grid.attr('data-case-cat');
        const state = $grid.attr('data-state');
        const s = $grid.attr('data-s');
        $.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'ajax_cpt',
            cat,
            caseCat,
            paged,
            post_type: postType,
            state,
            s,
            posts_per_page: postsPerPage
          },
          beforeSend() {
            if (loadmore) {
              $loadmore.hide();
              $grid.append(
                '<div class="lds-wrapper"><div class="lds-dual-ring"></div></div>'
              );
            } else {
              $('html, body').animate(
                {
                  scrollTop: $grid.offset().top - $('header').outerHeight() - 50
                },
                500
              );
              $grid.html(
                '<div class="lds-wrapper"><div class="lds-dual-ring"></div></div>'
              );
            }
          },
          success(res) {
            const data = JSON.parse(res);
            $('.lds-wrapper').remove();
            if (loadmore) {
              $grid.append(data.output);
            } else {
              $grid.html(data.output);
            }
            if (data.show_loadmore) {
              $loadmore.show();
            }
          },
          complete() {}
        });
      }

      // load more
      $loadmoreBtn.on('click', function() {
        let paged = parseInt($grid.attr('data-paged'));
        paged += 1;
        $grid.attr('data-paged', paged);
        ajaxCPT(true);
      });

      // click category
      $('.section-archive__filter__btn').on('click', function() {
        if ($(this).hasClass('is-active')) return;
        const $parent = $(this).closest('.accordion-body');
        const target = $(this).attr('data-target');
        const value = $(this).attr(target);
        $('.section-archive__filter__btn.is-active', $parent).removeClass(
          'is-active'
        );
        $(this).addClass('is-active');
        $grid.attr('data-paged', 1);
        $grid.attr(target, value);
        ajaxCPT();
      });

      // search cpt
      function instantSearch() {
        const search = $('.section-archive__search').val();
        $grid.attr('data-paged', 1);
        $grid.attr('data-s', search);
        ajaxCPT();
      }
      $('.section-archive__search').on(
        'keyup',
        helper.debounce(instantSearch, 300)
      );

      // filter btns
      $('.search-filter__btn').on('click', function() {
        const $buttons = $(this).closest('.search-filter__btns');
        const target = $(this).attr('data-target');
        const value = $(this).attr(target);
        if ($(this).hasClass('is-active')) return;
        $('.search-filter__btn.is-active').removeClass('is-active');
        $(this).addClass('is-active');
        $grid.attr(target, value);
        $grid.attr('data-paged', 1);
      });

      // pagination
      $(document).on('click', 'a.page-numbers', function(e) {
        e.preventDefault();
        if ($(this).hasClass('current')) return;
        $grid.attr('data-paged', $(this).html());
        ajaxCPT();
      });

      // confirm filters
      $('.search-filters__popup__apply').on('click', function() {
        $('.search-filters__popup').removeClass('is-active');
        ajaxCPT();
      });
      // next post pagination
      $('.next-posts').on('click', function() {
        let paged = parseInt($grid.attr('data-paged')),
          nextPaged = parseInt($('.max-page-num'));
        paged += 1;
        $grid.attr('data-paged', paged);
        $('.current-page-num').html(paged);
        $('.prev-posts').removeAttr('disabled');
        if (paged == nextPaged) $(this).attr('disabled', true);
        else $(this).removeAttr('disabled');
        ajaxCPT();
      });
      // prev post pagination
      $('.prev-posts').on('click', function() {
        let paged = parseInt($grid.attr('data-paged'));
        paged -= 1;
        $grid.attr('data-paged', paged);
        $('.current-page-num').html(paged);
        $('.next-posts').removeAttr('disabled');
        if (paged == 1) $(this).attr('disabled', true);
        else $(this).removeAttr('disabled');
        ajaxCPT();
      });
    },
    /**
     * init podcasts
     */
    initPodcasts() {
      const $slider = $('.podcasts-grid__inner'),
        option = {
          arrows: false,
          dots: false,
          autoplay: true,
          autoplaySpeed: 2000,
          variableWidth: true
        };
      helper.mobileSlider($slider, option);
      helper.windowResize(theme.initPodcasts);
    },
    /**
     * init attorney sidebar
     */
    initAttorneySidebar() {
      const $slider = $('.attorney-details__sidebar'),
        option = {
          arrows: false,
          dots: false,
          autoplay: true,
          autoplaySpeed: 2000,
          variableWidth: true
        };
      helper.mobileSlider($slider, option);
      helper.windowResize(theme.initAttorneySidebar);
    }
  };

  // Initialize Theme
  theme.init();
})(jQuery);
