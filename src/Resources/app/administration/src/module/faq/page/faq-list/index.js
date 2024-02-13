import template from './faq-list.html.twig';

const { Component } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('faq-list', {
  template,

  inject: ['repositoryFactory'],

  data() {
    return {
      faqs: null,
      repository: null,
      isLoading: false
    };
  },

  metaInfo() {
    return {
      title: this.$createTitle()
    };
  },

  computed: {
    columns() {
      return this.getColumns();
    }
  },

  created() {
    this.repository = this.repositoryFactory.create('faq');
    this.getList();
  },

  methods: {
    getList() {
      this.isLoading = true;
      const criteria = new Criteria();
      this.repository.search(criteria, Shopware.Context.api).then((result) => {
        this.faqs = result;
        this.isLoading = false;
      });
    },

    getColumns() {
      return [
        {
          property: 'question',
          dataIndex: 'question',
          label: this.$tc('faq.list.columnQuestion'),
          routerLink: 'faq.detail',
          allowResize: true,
          primary: true
        }, {
          property: 'answer',
          dataIndex: 'answer',
          label: this.$tc('faq.list.columnAnswer'),
          allowResize: true
        }
      ];
    }
  }
});