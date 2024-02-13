import deDE from './snippet/de-DE';
import enGB from './snippet/en-GB';

import './page/faq-list';

Shopware.Module.register('zanges-faq', {
    type: 'plugin',
    name: 'zanges-faq',
    title: 'faq.general.mainMenuItemGeneral',
    description: 'faq.general.descriptionTextModule',
    color: '#ff3d58',
    icon: 'default-shopping-paper-bag-product',
    entity: 'faq',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    routes: { 
        list: {
            component: 'faq-list',
            path: 'list'
        },
        create: {
            component: 'faq-create',
            path: 'create',
            meta: {
                parentPath: 'faq.list'
            }
        },
        detail: {
            component: 'faq-detail',
            path: 'detail/:id',
            meta: {
                parentPath: 'faq.list'
            }
        }
     },

    navigation: [{
        parent: 'sw-extension',
        id: 'zanges-faq',
        label: 'faq.general.mainMenuItemGeneral',
        color: '#ff3d58',
        path: 'zanges.faq.list',
        icon: 'default-shopping-paper-bag-product',
        position: 80
    }]
});