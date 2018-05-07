var wcs_filters_mixins={methods:{updateModelValue:function(t){this.$emit("input",t.target.value)}}},wcs_timetable_weekly_tabs_mixins={created:function(){this.stop=moment(this.start).utc().add(7,"days").format("YYYY-MM-DD")}},wcs_timetable_mixins={methods:{arrayIntersection:function(t,e){var s=[],a={},i=e.length,n,o;for(n=0;n<i;n++)a[e[n]]=!0;for(i=t.length,n=0;n<i;n++)(o=t[n])in a&&s.push(o);return s},addEvents:function(t){this.loading=t,this.loading.startLoader(),this.start=moment(this.stop).utc().add(1,"days").format("YYYY-MM-DD"),this.stop=moment(this.start).utc().add(parseInt(this.options.days)+1,"days").format("YYYY-MM-DD"),this.getEvents()},getEvents:function(){this.loading_process=!0,this.$http.get(ajaxurl,{params:{action:"wcs_get_events_json",content:void 0!==this.options.content?this.options.content:[],start:this.start,end:this.stop}}).then(this.responseSuccess,this.responseError)},getLimit:function(){return void 0!==this.options.limit&&parseInt(this.options.limit)>0&&0===parseInt(this.options.days)?this.options.limit:999999999999},filter_var:function(t){return-1!==["1","true","on","yes",!0,1].indexOf(t)},getFiltersType:function(){var t=this,e="checkbox";return this.filter_var(t.options.filters_style)&&(e="switch"),7===parseInt(t.options.view)&&(e="radio"),e},isFiltered:function(t){var e=this;if(!this.filter_var(e.options.show_past_events)&&!this.filter_var(t.future)&&this.filter_var(t.finished))return!0;var s=[],a=e.filters_active;for(var i in a)if(a.hasOwnProperty(i))if(a[i].length>0){var n=[];if(void 0!==t.terms[i])for(var o in t.terms[i])t.terms[i].hasOwnProperty(o)&&n.push(t.terms[i][o].slug);var r=void 0!==t.terms[i]?n:[];if("day_of_week"===i&&r.push(moment(t.start).utc().day()),"time_of_day"===i)switch(!0){case moment(t.start).utc().hour()>=0&&moment(t.start).utc().hour()<=11:r.push("morning");break;case moment(t.start).utc().hour()>11&&moment(t.start).utc().hour()<=16:r.push("afternoon");break;case moment(t.start).utc().hour()>16&&moment(t.start).utc().hour()<=23:r.push("evening");break}s.push(e.arrayIntersection(a[i],r).length>0)}else s.push(!0);return s.indexOf(!1)>=0},getActiveFilters:function(t){var e={};for(var s in t.taxonomies)t.taxonomies.hasOwnProperty(s)&&(e[s]=[]);return e.day_of_week=[],e.time_of_day=[],e},updateFilterModel:function(t,e,s){if(s){var a=[];e[0].length>0&&a.push(e[0]),this.filters_active[t]=a}else{var i=this,a=i.filters_active[t],n=e[0];a instanceof Array?a.indexOf(n)>=0?a.splice(a.indexOf(n),1):a.push(n):a=[n]}this.$emit("input",a),this.filterEvents()},filterEvents:function(){var t=this,e=[];t.events.forEach(function(s,a,i){t.isFiltered(s)&&e.push(s.hash)}),this.events_filtered=e},filterEvent:function(t){this.isFiltered(t)&&this.events_filtered.push(t.hash)},responseSuccess:function(t){var e=this,s=[],a=[];t.body.forEach(function(t,s,a){-1===e.events_hases.indexOf(t.hash)&&(e.events_hases.push(t.hash),e.filterEvent(t),e.events.push(t))}),this.loading_process=!1,this.loading&&this.loading.stopLoader()},responseError:function(t){this.loading_process=!1,this.loading&&this.loading.stopLoader()},openTaxModal:function(t,e,s){s.preventDefault(),wcs_vue_modal.openModal(t,e)},openModal:function(t,e,s){var a=this,i=void 0===t.excerpt||a.hasModal(t);i||2!==parseInt(e.modal)||("#"===s.target.getAttribute("href")&&s.preventDefault(),void 0!==t.permalink&&a.filter_var(window.wcs_settings.hasSingle)&&(window.location=t.permalink)),i&&void 0===t.start&&(i=!1),i&&!this.filter_var(t.visible)&&(i=!1),i&&(s.preventDefault(),wcs_vue_modal.openModal(t,e))},hasTax:function(t,e){var s=!0;return void 0!==this.options["show_"+t]&&this.filter_var(this.options["show_"+t])||(s=!1),s&&(void 0===e.terms[t]||e.terms[t].length<=0)&&(s=!1),s},hasModal:function(t){var e=this,s=e.options,a=!0;return 2===parseInt(s.modal)&&(a=!1),a&&!e.filter_var(s.show_description)&&(a=!1),a&&void 0!==t.excerpt&&0===t.excerpt.length&&(a=!1),a},hasLink:function(t){var e=this,s=e.options,a=!0;return this.hasModal(t,s)&&(a=!1),a&&!e.filter_var(wcs_settings.hasSingle)&&(a=!1),a&&void 0===t.permalink&&(a=!1),a},hasMoreButton:function(){var t=!0;return this.filter_var(this.options.show_more)||(t=!1),this.options.days&&0!==parseInt(this.options.days)||(t=!1),parseInt(this.options.days)>28&&(t=!1),t},hasFilters:function(){var t=this,e=[];for(index in t.filters.taxonomies)e.push(this.filter_var(this.options["show_filter_"+index]));return e.indexOf(!0)>=0},hasToggler:function(){var t=this.status.toggler;return t&&(t=this.hasFilters()),t&&1!==parseInt(this.options.filters_position)&&(this.filters.visible=!0,t=!1),t&&8===parseInt(this.options.view)&&(this.filters.visible=!0,t=!1),t},termsList:function(t){return t.length>0},event_time:function(t){return t=moment(t).utc(),t.format(this.filter_var(this.options.show_time_format)?"h":"HH")+"<span class='wcs-addons--blink'>:</span>"+t.format("mm")+(this.filter_var(this.options.show_time_format)?t.format("a"):"")},starting_ending:function(t){return this.event_time(t.start)+(this.filter_var(this.options.show_ending)?" - "+this.event_time(t.end):"")}},computed:{events_list:function(){var t=this,e=[],s=t.getLimit();return t.filterEvents(),t.events.forEach(function(a,i){s>0&&(0!==t.events_filtered.length&&-1!==t.events_filtered.indexOf(a.hash)||(e.push(a),s--))}),e.length>0&&e},events_by_day:function(){var t=this,e={},s=t.getLimit();return t.filterEvents(),t.events.forEach(function(a,i){if(0===t.events_filtered.length||-1===t.events_filtered.indexOf(a.hash)){var n=moment(a.start).utc().year(),o=moment(a.start).utc().month()+1,r=moment(a.start).utc().date(),c=n+"_"+o+"_"+r;s>0&&(c in e?e[c].events.push(a):e[c]={date:moment(a.start).utc(),events:[a]},s--)}}),e},all_days:function(){var t=this,e={};return t.filterEvents(),t.events.forEach(function(t,s){var a=moment(t.start).utc().year(),i=moment(t.start).utc().month()+1,n=moment(t.start).utc().date(),o=a+"_"+i+"_"+n;o in e||(e[o]={date:moment(t.start).utc()})}),e},active_day:function(){var t=this;return t.selected_day?t.selected_day:Object.keys(t.all_days)[0]},filters_classes:function(){var t="";return void 0!==this.options.filters_style&&this.filter_var(this.options.filters_style)&&(t="wcs-filters--switches"),7===parseInt(this.options.view)&&(t="wcs-filters--inline")," "+t},app_classes:{get:function(){return this.css_classes.join(" ")},set:function(t){this.css_classes.push(t)}}}},wcs_modal_mixins={computed:{modal_classes:function(){var t=[];return t.push(this.data.image?"wcs-modal--with-image":"wcs-modal--without-image"),this.classes+" "+t.join(" ")}},methods:{filter_var:function(t){return-1!==["1","true","on","yes",!0,1].indexOf(t)},closeModal:function(t){var e=t.target.className.split(" ");(e.indexOf("wcs-modal")>=0||e.indexOf("wcs-modal__close")>=0)&&(t.preventDefault(),wcs_vue_modal.visible=!1,wcs_vue_modal.loading=!0)}}},wcs_carousel_mixin={mounted:function(){var t=this;jQuery(".wcs-class:not(.vue-element)",t.$el).each(function(){jQuery(this).addClass("vue-element")}),jQuery(document).ready(function(){jQuery(".wcs-timetable__parent",t.$el).imagesLoaded(function(){t.$refs.carousel=jQuery(".wcs-timetable__parent",t.$el).owlCarousel(t.carousel_data_options).owlCarousel("refresh")})})},watch:{events_list:function(){var t=this;jQuery(".wcs-timetable__parent > .wcs-class:not(.vue-element)",t.$el).each(function(){t.$refs.carousel.owlCarousel("add",jQuery(this).addClass("vue-element")).owlCarousel("update")}),"function"==typeof t.$refs.carousel.trigger&&t.$refs.carousel.trigger("next.owl.carousel").trigger("prev.owl.carousel").owlCarousel("refresh")}},computed:{carousel_data_options:function(){var t=this;return{margin:parseInt(t.options.carousel_items_spacing),dots:t.filter_var(t.options.carousel_dots),nav:t.filter_var(t.options.carousel_nav),loop:t.filter_var(t.options.carousel_loop),autoplay:t.filter_var(t.options.carousel_autoplay),autoplayTimeout:parseInt(t.options.carousel_autoplay_speed),autoplayHoverPause:!0,navText:void 0!==t.options.carousel_next&&void 0!==t.options.carousel_prev?[t.options.carousel_next,t.options.carousel_prev]:["",""],lazyLoad:!0,stagePadding:parseInt(t.options.carousel_padding),responsive:{0:{items:parseInt(t.options.carousel_items_xs)},600:{items:parseInt(t.options.carousel_items_md)},1200:{items:parseInt(t.options.carousel_items_lg)},1600:{items:parseInt(t.options.carousel_items_xl)}}}}}};"undefined"!=typeof VueImagesLoaded&&(wcs_carousel_mixin.directives={imagesLoaded:VueImagesLoaded});var wcs_timetable_monthly_mixins={mounted:function(){var t=this,e=jQuery(".wcs-timetable__monthly-schedule",t.$el).fullCalendar({header:{left:"prev,next today",center:"title",right:"month,agendaWeek,agendaDay,listWeek"},events:function(e,s,a,i){t.start=e.toISOString(),t.stop=s.toISOString(),t.$http.get(ajaxurl,{params:{action:"wcs_get_events_json",content:void 0!==t.options.content?t.options.content:[],start:t.start,end:t.stop}}).then(function(e){var s=t;e.body.forEach(function(t,e,a){-1===s.events_hases.indexOf(t.hash)&&(s.events_hases.push(t.hash),s.filterEvent(t),s.events.push(t))}),this.loading&&this.loading.stopLoader(),i(t.events)})},eventClick:function(e,s){t.openModal(e,t.options,s)},timeFormat:12===parseInt(t.options.show_time_format)?"h(:mm)t":"H(:mm)",firstDay:wcs_locale.firstDay,monthNames:wcs_locale.monthNames,monthNamesShort:wcs_locale.monthNamesShort,dayNames:wcs_locale.dayNames,dayNamesShort:wcs_locale.dayNamesShort,eventLimit:t.filter_var(t.options.calendar_limit),allDaySlot:!1,height:!t.filter_var(t.options.calendar_sticky)&&"auto",weekends:t.filter_var(t.options.calendar_weekends),loading:function(e){e?jQuery('<div class="wcs-calendar-loading"><div class="wcs-spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect5"></div></div></div>').appendTo(t.$el):jQuery(".wcs-calendar-loading",t.$el).remove()}})},methods:{responseSuccessMonthly:function(){},errorSuccessMonthly:function(){}}},wcs_timetable_isotope_mixins={mounted:function(){var t=this},updated:function(){},watch:{filters_active:{handler:function(t){this.$refs.cpt.filters_active=t,this.$refs.cpt.filter("isFilteredVal")},deep:!0}},methods:{isZero:function(){return void 0!==this.$refs.cpt&&void 0!==this.$refs.cpt.iso&&void 0!==this.$refs.cpt.iso.filteredItems&&this.$refs.cpt.iso.filteredItems.length<=2},getLabelAll:function(t){return void 0!==this.options["label_grid_all_"+t]&&this.options["label_grid_all_"+t].length>0?this.options["label_grid_all_"+t]:this.filters.taxonomies[t].label_all},layout:function(){this.$refs.cpt.layout("masonry")},isFilteredVal:function(){var t=this;this.isZero()?jQuery(".wcs-timetable__zero-data",t.$el).show():jQuery(".wcs-timetable__zero-data",t.$el).hide()},getIsotopeOptions:function(){return{itemSelector:".wcs-iso-item",percentPosition:!0,masonry:{columnWidth:".wcs-isotope-item",gutter:".wcs-isotope-gutter"},getSortData:{timestamp:function(t){return void 0!==t&&void 0!==t.timestamp?t.timestamp:0}},sortBy:"timestamp",getFilterData:{isFilteredVal:function(t){var e=this.filters_active,s=!0;if(void 0!==e&&e)for(var a in e)if(["time_of_day","day_of_week"].indexOf(a)>=0&&e[a].length>0&&e[a][0].length>0&&void 0!==t){if("day_of_week"===a&&_.intersection(e[a],[moment(t.start).utc().day().toString()]).length<=0)s=!1;else if("time_of_day"===a){switch(!0){case moment(t.start).utc().hour()>=0&&moment(t.start).utc().hour()<=11:var i=["morning"];break;case moment(t.start).utc().hour()>11&&moment(t.start).utc().hour()<=16:var i=["afternoon"];break;case moment(t.start).utc().hour()>16&&moment(t.start).utc().hour()<=23:var i=["evening"];break}var n=_.intersection(e[a],i);n.length<=0&&(s=!1)}}else e[a].length>0&&e[a][0].length>0&&void 0!==t&&_.intersection(e[a],_.map(t.terms[a],function(t){return t.slug})).length<=0&&(s=!1);return s}}}},expandIsotopeItem:function(t,e){console.log(),this.iso_expanded_items.push(t),e.target.parentElement.parentElement.className+=" wcs-class--active",this.layout()},minimizeIsotopeItem:function(t,e){this.iso_expanded_items.splice(this.iso_expanded_items.indexOf(t),1),e.target.parentElement.parentElement.className=e.target.parentElement.parentElement.className.replace(" wcs-class--active",""),this.layout()},isIsotopeExpanded:function(t,e){return this.iso_expanded_items.indexOf(t)>=0}},filters:{eventCSSIsotope:function(t,e){var s=[];return void 0!==e.expanded&&s.push("wcs-class--active"),t+" "+s.join(" ")}},computed:{isotope_events_list:function(){var t=this,e=[],s=t.getLimit();return t.events.forEach(function(t,a){s>0&&(e.push(t),s--)}),e.length>0&&e}}};"undefined"!=typeof VueImagesLoaded&&(wcs_timetable_isotope_mixins.directives={imagesLoaded:VueImagesLoaded});var wcs_timetable_timeline_mixins={methods:{layout:function(){this.$refs.timeline.layout("masonry")},getIsotopeOptions:function(){return{itemSelector:".wcs-iso-item",percentPosition:!0,masonry:{columnWidth:".wcs-isotope-item",gutter:".wcs-isotope-gutter"}}}},filters:{eventCSSIsotope:function(t,e){var s=[];return void 0!==e.expanded&&s.push("wcs-class--active"),t+" "+s.join(" ")}}},wcs_timetable_weekly_mixins={created:function(){this.filter_var(this.options.show_navigation)&&(this.options.show_past_events=!0),this.stop=moment(this.start).utc().add(7,"days").format("YYYY-MM-DD"),this.filter_var(this.options.show_starting_hours)&&(this.app_classes="wcs-timetable--grouped-by-hours"),this.dateRange.start=moment(this.today).startOf("isoWeek").format("YYYY-MM-DD"),this.dateRange.stop=moment(this.today).endOf("isoWeek").format("YYYY-MM-DD"),this.dateRangeHistory.push(this.dateRange.start+"/"+this.dateRange.stop)},computed:{dateRangeTitle:function(){var t="";return t=moment(this.dateRange.start).isSame(this.dateRange.stop,"month")?moment(this.dateRange.start).format("MMMM")+" "+moment(this.dateRange.start).format("D")+" - "+moment(this.dateRange.stop).format("D"):moment(this.dateRange.start).format("MMMM D")+" - "+moment(this.dateRange.stop).format("MMMM D")},week:function(){var t=this,e=parseInt(wcs_locale.firstDay),s={};for($i=e;$i<=e+7;$i++){var a=$i<=6?$i:Math.abs($i-7);s["day_"+a]={day_num:a,events:[]}}return t.events.forEach(function(e,a){!t.inRange(e)||0!==t.events_filtered.length&&-1!==t.events_filtered.indexOf(e.hash)||s["day_"+moment(e.start).utc().format("e")].events.push(e)}),s},starting_times:function(){var t=this,e=[];return t.events.forEach(function(t,s){e.indexOf(moment(t.start).utc().format("HH:mm"))<0&&e.push(moment(t.start).utc().format("HH:mm"))}),e.sort(),e}},filters:{eventSlotCSS:function(t,e){return t+" wcs-class--slots-"+e.period/10},check12format:function(t,e){if(!0!==e&&"true"!==e&&"1"!==e&&1!==e)return t;var s=t.split(":");switch(parseInt(s[0])){case 1:return"1:"+s[1]+"am";break;case 2:return"2:"+s[1]+"am";break;case 3:return"3:"+s[1]+"am";break;case 4:return"4:"+s[1]+"am";break;case 5:return"5:"+s[1]+"am";break;case 6:return"6:"+s[1]+"am";break;case 7:return"7:"+s[1]+"am";break;case 8:return"8:"+s[1]+"am";break;case 9:return"9:"+s[1]+"am";break;case 10:return"10:"+s[1]+"am";break;case 11:return"11:"+s[1]+"am";break;case 12:return"12:"+s[1]+"pm";break;case 13:return"1:"+s[1]+"pm";break;case 14:return"2:"+s[1]+"pm";break;case 15:return"3:"+s[1]+"pm";break;case 16:return"4:"+s[1]+"pm";break;case 17:return"5:"+s[1]+"pm";break;case 18:return"6:"+s[1]+"pm";break;case 19:return"7:"+s[1]+"pm";break;case 20:return"8:"+s[1]+"pm";break;case 21:return"9:"+s[1]+"pm";break;case 22:return"10:"+s[1]+"pm";break;case 23:return"11:"+s[1]+"pm";break;case 24:return"12:"+s[1]+"am";break;default:return t}}},methods:{inRange:function(t){return!this.filter_var(this.options.show_navigation)||!(!moment(this.dateRange.start).subtract(1,"days").isBefore(t.start)||!moment(this.dateRange.stop).add(1,"days").isAfter(t.start))},navigationGoNext:function(){this.dateRange.start=moment(this.dateRange.start).add(7,"days").format("YYYY-MM-DD"),this.dateRange.stop=moment(this.dateRange.start).add(6,"days").format("YYYY-MM-DD"),-1===this.dateRangeHistory.indexOf(this.dateRange.start+"/"+this.dateRange.stop)&&(this.dateRangeHistory.push(this.dateRange.start+"/"+this.dateRange.stop),this.start=this.dateRange.start,this.stop=this.dateRange.stop,this.getEvents())},navigationGoPrev:function(){this.dateRange.start=moment(this.dateRange.start).subtract(7,"days").format("YYYY-MM-DD"),this.dateRange.stop=moment(this.dateRange.start).add(6,"days").format("YYYY-MM-DD"),-1===this.dateRangeHistory.indexOf(this.dateRange.start+"/"+this.dateRange.stop)&&(this.dateRangeHistory.push(this.dateRange.start+"/"+this.dateRange.stop),this.start=this.dateRange.start,this.stop=this.dateRange.stop,this.getEvents())},hasHourlyEvents:function(t){var e=this,s=e.week,a=!1;for(var i in s)if(void 0!==e.week[i].events&&!1!==e.getHourlyEvents(t,e.week[i].events)){a=!0;break}return a},getHourlyEvents:function(t,e){var s=this,a=[];return e.forEach(function(e,s){t===moment(e.start).utc().format("HH:mm")&&a.push(e)}),a.length>0&&a},countWeekEvents:function(){var t=this,e=0;for(var s in t.week)e+=t.week[s].events.length;return e},day_name:function(t){return wcs_locale.dayNames[t]}}},wcs_timetable_countdown={created:function(){var t=this;t.countdown.asMilliseconds()>0&&window.setInterval(function(){t.now=moment().utc()},1e3)},mounted:function(){var t=[];t.push(this.filter_var(this.options.countdown_vertical)?"wcs-timetable--countdown-vertical":"wcs-timetable--countdown-default"),this.$el.querySelector(".wcs-timetable--countdown").className+=" "+t.join(" ")},computed:{timestamp:function(){return moment(1e3*(parseInt(this.single.timestamp)+-1*parseInt(wcs_locale.gmtOffset))).utc()},countdown:function(){return moment.duration(this.timestamp.diff(this.now))},remaining_years:function(){var t=this.countdown.years();return t<=0?0:t},remaining_months:function(){var t=this.countdown.months();return(void 0===this.options.label_countdown_years||this.options.label_countdown_years.length<=0)&&(t+=365*this.remaining_years),t<=0?0:t},remaining_days:function(){var t=this.countdown.days();return(void 0===this.options.label_countdown_months||this.options.label_countdown_months.length<=0)&&(t+=30*this.remaining_months),t<=0?0:t},remaining_hours:function(){var t=this.countdown.hours();return(void 0===this.options.label_countdown_days||this.options.label_countdown_days.length<=0)&&(t+=24*this.remaining_days),t<=0?0:t},remaining_minutes:function(){var t=this.countdown.minutes();return(void 0===this.options.label_countdown_hours||this.options.label_countdown_hours.length<=0)&&(t+=60*this.remaining_hours),t<=0?0:t},remaining_seconds:function(){var t=this.countdown.seconds();return(void 0===this.options.label_countdown_minutes||this.options.label_countdown_minutes.length<=0)&&(t+=60*this.remaining_minutes),t<=0?0:t}},filters:{leadingZero:function(t){return parseInt(t)<=9?"0"+t:t}},methods:{timeLabel:function(t){var e=this.options["label_countdown_"+t].split(",");return e.length>1?1==this["remaining_"+t]?e[0]:e[1]:e[0]}}},wcs_timetable_cover={mounted:function(){var t=[];switch(!0){case 0==this.options.cover_text_position:t.push("wcs-timetable--cover-position-top-left");break;case 1==this.options.cover_text_position:t.push("wcs-timetable--cover-position-top-center");break;case 2==this.options.cover_text_position:t.push("wcs-timetable--cover-position-top-right");break;case 3==this.options.cover_text_position:t.push("wcs-timetable--cover-position-middle-left");break;case 4==this.options.cover_text_position:t.push("wcs-timetable--cover-position-middle-center");break;case 5==this.options.cover_text_position:t.push("wcs-timetable--cover-position-middle-right");break;case 6==this.options.cover_text_position:t.push("wcs-timetable--cover-position-bottom-left");break;case 7==this.options.cover_text_position:t.push("wcs-timetable--cover-position-bottom-center");break;case 8==this.options.cover_text_position:t.push("wcs-timetable--cover-position-bottom-right");break}switch(!0){case 0==this.options.cover_text_align:t.push("wcs-timetable--cover-align-left");break;case 1==this.options.cover_text_align:t.push("wcs-timetable--cover-align-center");break;case 2==this.options.cover_text_align:t.push("wcs-timetable--cover-align-right");break}switch(!0){case 0==this.options.cover_text_size:t.push("wcs-timetable--cover-text-size-sm");break;case 1==this.options.cover_text_size:t.push("wcs-timetable--cover-text-size-md");break;case 2==this.options.cover_text_size:t.push("wcs-timetable--cover-text-size-lg");break}switch(!0){case 0==this.options.cover_aspect:t.push("wcs-timetable--cover-aspect-169");break;case 1==this.options.cover_aspect:t.push("wcs-timetable--cover-aspect-169v");break;case 2==this.options.cover_aspect:t.push("wcs-timetable--cover-aspect-43");break;case 3==this.options.cover_aspect:t.push("wcs-timetable--cover-aspect-43v");break;case 4==this.options.cover_aspect:t.push("wcs-timetable--cover-aspect-11");break}t.push(void 0!==this.single.thumbnail&&this.single.thumbnail.length>0?"wcs-timetable--cover-with-image":"wcs-timetable--cover-without-image"),t.push(void 0!==this.options.cover_overlay_type&&0==parseInt(this.options.cover_overlay_type)?"wcs-timetable--cover-overlay-image":"wcs-timetable--cover-overlay-text"),this.$el.querySelector(".wcs-timetable--cover").className+=" "+t.join(" ")},methods:{hasImage:function(){return void 0!==this.single.thumbnail&&this.single.thumbnail.length>0}},filters:{bgImage:function(t){return void 0!==t&&t.length>0?'background-image: url("'+t+'")':""}}},wcs_mixins_monthly_calendar={created:function(){var t=this;if(this.loading_history.push(this.start+this.stop),this.updateCalendar(this.events),null===this.selectedDay){var e=this.today,s=moment(e).utc().endOf("month").diff(moment(e).utc(),"days"),a=!1;for($day=1;$day<=s;$day++){var i=moment(e).utc().add($day,"days").format("YYYY-MM-DD"),n=t.getDayEvents(i);if(n.length>=0&&n.forEach(function(t,e,s){moment(t.start).utc().isAfter(moment().utc())&&(a=!0)}),a&&(e=i),a)break}this.selectedDay={date:e,events:this.getDayEvents(e)}}},watch:{events:function(t){var e=this;this.updateCalendar(t)}},mounted:function(){},computed:{days:function(){var t=[],e=parseInt(wcs_locale.firstDay);e=0===e?7:e;for(var s=this.today,a=moment(this.calendarDay?this.calendarDay:s).format("YYYY-MM-DD"),i=Math.abs((e-7-moment(a).startOf("month").isoWeekday())%7),n=Math.abs(7-moment(a).endOf("month").isoWeekday()),o=moment(a).startOf("month").subtract(i>=6?-1:i,"days"),r=moment(a).endOf("month").add(n,"days"),c=moment(o);c.diff(r,"days")<=0;c.add(1,"days"))t.push({date:c.format("YYYY-MM-DD"),past:moment(moment(a).startOf("month").format("YYYY-MM-DD")).isAfter(c.format("YYYY-MM-DD"),"day"),future:moment(c.format("YYYY-MM-DD")).isAfter(moment(a).endOf("month").format("YYYY-MM-DD"),"day"),today:c.isSame(s,"day"),events:this.getDayEvents(c.format("YYYY-MM-DD"))});return t},week:function(){var t=this,e=parseInt(wcs_locale.firstDay),s={};for($i=e;$i<=e+7;$i++){var a=$i<=6?$i:Math.abs($i-7);s["day_"+a]={day_num:a,events:[]}}return s},getCurrentMonth:function(){return moment(this.calendarDay?this.calendarDay:this.today).format("MMMM YYYY")},getCurrentWeek:function(){return moment(this.calendarDay?this.calendarDay:this.today).utc().startOf("month").format("W")},calendarClasses:function(){var t=[];switch(parseInt(this.options.mth_cal_agenda_position)){case 1:t.push("wcs-timetable--side-agenda wcs-timetable--side-agenda-left");break;case 2:t.push("wcs-timetable--side-agenda wcs-timetable--side-agenda-right");break;case 3:t.push("wcs-timetable--inside-agenda");break;default:t.push("wcs-timetable--bellow-agenda")}switch(parseInt(this.options.mth_cal_borders)){case 1:t.push("wcs-timetable--horizontal-borders");break;case 2:t.push("wcs-timetable--vertical-borders");break;case 3:t.push("wcs-timetable--all-borders");break;default:t.push("wcs-timetable--no-borders")}return this.filter_var(this.options.mth_cal_rows)&&t.push("wcs-timetable--alternate"),this.filter_var(this.options.mth_cal_highlight)&&t.push("wcs-timetable--highligh-round"),this.filter_var(this.options.show_past_events)||t.push("wcs-timetable--past-hidden"),this.loading_process&&t.push("wcs-timetable--loading"),t.join(" ")}},filters:{eventSlotCSS:function(t,e){return t+" wcs-class--slots-"+e.period/10}},methods:{isNavVisible:function(t){if(!this.options.label_mth_prev||!this.options.label_mth_next)return!1;var e=moment(this.calendarDay?this.calendarDay:this.today).utc().format("YYYY-MM-DD");return!(!this.filter_var(this.options.show_past_events)&&"prev"==t&&moment(e).utc().startOf("month").subtract(1,"days").isBefore(this.today,"month"))},isAgendaInside:function(t){var e=!1;return 3==this.options.mth_cal_agenda_position&&moment(this.selectedDay.date).utc().format("W")==parseInt(this.getCurrentWeek)+t-1&&(e=!0),e},selectDay:function(t,e){t.future||t.past||t.events.length<=0||!this.filter_var(this.options.show_past_events)&&moment(this.today).utc().isAfter(t.date,"day")||(this.selectedDay=t,e.target.parentElement.className+=" wcs-week--selected")},updateCalendar:function(t){var e=this;t.forEach(function(t,s){var a=moment(t.start).utc(),i=a.format("YYYY"),n=a.format("MM"),o=a.format("DD");void 0===e.calendar["year_"+i]&&e.$set(e.calendar,"year_"+i,{}),void 0===e.calendar["year_"+i]["month_"+n]&&e.$set(e.calendar["year_"+i],"month_"+n,{}),void 0===e.calendar["year_"+i]["month_"+n]["day_"+o]&&e.$set(e.calendar["year_"+i]["month_"+n],"day_"+o,[]);var r=!0;e.calendar["year_"+i]["month_"+n]["day_"+o].forEach(function(e,s){e.hash===t.hash&&(r=!1)}),r&&e.calendar["year_"+i]["month_"+n]["day_"+o].push(t)})},getDayEvents:function(t){var e=this,s=[],a=moment(t),i=a.format("YYYY"),n=a.format("MM"),o=a.format("DD");return void 0!==e.calendar["year_"+i]&&void 0!==e.calendar["year_"+i]["month_"+n]&&void 0!==e.calendar["year_"+i]["month_"+n]["day_"+o]&&(s=e.calendar["year_"+i]["month_"+n]["day_"+o]),s},getFilteredCalendarEvents:function(t){var e=this,s=[];return void 0!==this.events_filtered&&this.events_filtered.length>=1?t.forEach(function(t,a){e.events_filtered.indexOf(t.hash)<0&&s.push(t)}):t.forEach(function(t,e){s.push(t)}),s},subtractMonth:function(){this.loading_process||(this.calendarDay=moment(this.calendarDay?this.calendarDay:this.today).subtract(1,"month").format("YYYY-MM-DD"),this.checkForCalendarUpdate())},addMonth:function(){this.loading_process||(this.calendarDay=moment(this.calendarDay?this.calendarDay:this.today).add(1,"month").format("YYYY-MM-DD"),this.checkForCalendarUpdate())},checkForCalendarUpdate:function(){this.start=moment(this.calendarDay).startOf("month").format("YYYY-MM-DD"),this.stop=moment(this.calendarDay).endOf("month").format("YYYY-MM-DD"),this.loading_history.indexOf(this.start+this.stop)<0&&(this.loading_history.push(this.start+this.stop),this.getEvents())},isWeekday:function(t,e){if(this.filter_var(this.options.mth_cal_show_weekends))return!0;var s=[6,7];return t=!0===e?0===t?7:t:moment(t.date).isoWeekday(),!(s.indexOf(t)>=0)},countWeekEvents:function(){var t=this,e=0;for(var s in t.week)e+=t.week[s].events.length;return e},day_name:function(t){var e=[];switch(this.options.mth_cal_day_format){case"ddd":e=wcs_locale.dayNamesShort[t];break;case"d":e=wcs_locale.dayNamesMin[t];break;default:e=wcs_locale.dayNames[t]}return e},dayClasses:function(t){var e=[];return t.past&&e.push("wcs-date--past-month"),t.future&&e.push("wcs-date--future-month"),t.today&&e.push("wcs-date--today"),t.events.length>0&&moment(t.date).isSame(this.calendarDay?this.calendarDay:this.today,"month")&&this.getFilteredCalendarEvents(t.events).length>0&&e.push("wcs-date--with-events wcs-modal-call"),moment(this.today).utc().isAfter(t.date,"day")&&e.push("wcs-date--past"),moment(this.today).utc().isBefore(t.date,"day")&&e.push("wcs-date--future"),moment(t.date).utc().isSame(this.selectedDay.date,"day")&&e.push("wcs-date--selected"),e.join(" ")},weekClasses:function(t){var e=[],s=parseInt(this.getCurrentWeek)+t-1;return e.push("wcs-week--"+s),moment(this.selectedDay.date).utc().format("W")==s&&e.push("wcs-week--selected"),e.join(" ")}}};