Vue.component('dialog-container', require('./components/dialogs/DialogContainer.vue').default);

Vue.component('article-list', require('./views/web/articles/ArticleList.vue').default);
Vue.component('selected-article', require('./views/web/articles/SelectedArticle.vue').default);

Vue.component('data-table', require('./components/lists/DataTable.vue').default);
Vue.component('chart', require('./components/charts/Chart.vue').default);


Vue.component('admin-svg', require('./views/web/svg-login/admin-svg.vue').default);
Vue.component('manager-svg', require('./views/web/svg-login/manager-svg.vue').default);
Vue.component('sales-svg', require('./views/web/svg-login/sales-svg.vue').default);

Vue.component('user-profile', require('./views/web/profile/SalesProfile.vue').default);
Vue.component('user-change-password', require('./views/web/profile/ChangePassword.vue').default);
Vue.component('po-request-create', require('./views/web/po-requests/PORequestCreate.vue').default);
Vue.component('po-request-table', require('./views/web/po-requests/PORequestsTable.vue').default);
Vue.component('ppp-doughnut', require('./views/web/ppp-available/DoughnutChart.vue').default);
