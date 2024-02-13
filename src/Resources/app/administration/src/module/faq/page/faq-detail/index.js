import template from './faq-detail.html.twig';

const { Component, Mixin } = Shopware;

Component.register('faq-detail', {
  template,
  
  inject: [
    'repositoryFactory'
  ],

  mixins: [
    Mixin.getByName('notification')
  ],

  data() {
    return {
      faq: null,
      isLoading: false,
      processSuccess: false,
      repository: null
    };
  },

  metaInfo() {
    return {
      title: this.$createTitle()
    };
  },

  created() {
    this.createdComponent();
  },

  methods: {
    createdComponent() {
      this.isLoading = true;
      this.repository = this.repositoryFactory.create('faq');
      console.log(this.repository);
      this.getFaq();
    },

    getFaq() {
      this.repository.get(this.$route.params.id, Shopware.Context.api).then((entity) => {
        this.faq = entity;
        this.isLoading = false;
      });
    },

    onClickSave() {
      this.isLoading = true;

      this.repository.save(this.faq, Shopware.Context.api).then(() => {
        this.getFaq();
        this.isLoading = false;
        this.processSuccess = true;
      }).catch((exception) => {
        this.createNotificationError({
          title: this.$tc('faq.detail.errorTitle'),
          message: exception
        });
        this.isLoading = false;
      });
    },

    saveFinish() {
      this.processSuccess = false;
    }
  }
});