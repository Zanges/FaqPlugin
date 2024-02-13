Shopware.Component.extend('faq-create', 'faq-detail', {
  methods: {
    getFaq() {
      this.isLoading = true;
      this.faq = this.repository.create(Shopware.Context.api);
      this.isLoading = false;
    },
    
    onClickSave() {
      this.isLoading = true;

      this.repository.save(this.faq, Shopware.Context.api).then(() => {
        this.isLoading = false;
        this.$router.push({ name: 'zanges.faq.detail', params: { id: this.faq.id } });
      }).catch((exception) => {
        this.createNotificationError({
          title: this.$tc('faq.detail.errorTitle'),
          message: exception
        });
        this.isLoading = false;
      });
    }
  }
});