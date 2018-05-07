/** Filters Components */
Vue.component( 'filter-checkbox', {
  template: '#wcs_templates_filter--checkbox',
	props: [ 'filter', 'options', 'value', 'title', 'slug', 'name', 'unique_id', 'level' ],
	mixins: [wcs_filters_mixins]
});

Vue.component( 'filter-switch', {
  template: '#wcs_templates_filter--switch',
	props: [ 'filter', 'options', 'value', 'title', 'slug', 'name', 'unique_id', 'level' ],
	mixins: [wcs_filters_mixins]
});
Vue.component( 'filter-radio', {
  template: '#wcs_templates_filter--radio',
	props: [ 'filter', 'options', 'value', 'title', 'slug', 'name', 'unique_id' ],
	methods: {
		isChecked: function(slug, value){
			var $checked = false;
			if( ( typeof slug !== 'undefined' ? slug.toString() : '' ) === ( value.length > 0 ? value[0].toString() : '' ) ){
				$checked = true;
			}
			return $checked;
		},
		updateRadioModelValue: function( event ){
			this.$refs.input.value = event.target.value;
			this.checked = this.$refs.input.value;
			this.$emit( 'input', this.$refs.input.value );
		}
	},
	mixins: [wcs_filters_mixins]
});


/** Loader Components */
Vue.component( 'wcs-loader', {
  template: '#wcs_templates_misc--loader'
});

Vue.component( 'wcs-modal', {
  template: '<div>sstst</div>'
});

/** Modal Components */
Vue.component( 'modal-normal', {
  template: '#wcs_templates_modal--normal',
	props: [ 'data', 'options', 'classes' ],
	mixins: [wcs_modal_mixins],
  methods: {
    openTaxModal: function( data, options, event ){
			event.preventDefault();
			wcs_vue_modal.openModal( data, options );
		}
  }
});

Vue.component( 'modal-large', {
  template: '#wcs_templates_modal--large',
	props: [ 'data', 'options' , 'classes'],
	mixins: [wcs_modal_mixins],
  methods: {
    openTaxModal: function( data, options, event ){
			event.preventDefault();
			wcs_vue_modal.openModal( data, options );
		}
  }
});

Vue.component( 'modal-taxonomy', {
  template: '#wcs_templates_modal--taxonomy',
	props: [ 'data', 'options', 'content', 'classes' ],
	mixins: [wcs_modal_mixins]
});

/** Misc. Components */
Vue.component( 'button-more', {
  template: '#wcs_templates_misc--button-more',
	props: [ 'color', 'more' ],
	methods: {
		startLoader: function(){
			this.ladda.start();
		},
		stopLoader: function(){
			this.ladda.stop();
		},
		addEvents: function(){
			this.$emit( 'add-events', this );
		}
	},
	mounted: function(){
    this.ladda = Ladda.create( this.$el );
	}
});
Vue.component('taxonomy-list', {
  template : ''+
    '<span><template v-for="(room, index) in event.terms[tax]">' +
      '<template v-if="room.url"><a :href="room.url">{{room.name}}</a></template>' +
      '<template v-else-if="room.desc"><a href="#" class="wcs-modal-call" v-on:click="openModal( room, options, $event )">{{room.name}}</a></template>' +
      '<template v-else>{{room.name}}</template>' +
      '<template v-if="index !== (event.terms[tax].length - 1)">, </template>' +
    '</template></span>' ,
  props    : [ 'tax', 'options', 'event' ],
  methods  : {
    openModal: function( item, options, $event ){
      this.$emit( 'open-modal', item, options, $event );
    }
  }
});
