Vue.component('group-bar-chart', require('./views/dashboards/GroupBarChart.vue').default);
Vue.component('doughnut-chart', require('./views/dashboards/DoughnutChart.vue').default);

Vue.component('manager-user-view', require('./views/manager/manager-users/ManagerView.vue').default);
Vue.component('change-password', require('./views/manager/profile/ChangePassword.vue').default);

Vue.component('manager-po-request-create', require('./views/manager/po-requests/PORequestCreate.vue').default);
Vue.component('manager-po-request-table', require('./views/manager/po-requests/PORequestsTable.vue').default);

Vue.component('manager-ppp-request-table', require('./views/manager/ppp-requests/PPPRequestsTable.vue').default);
Vue.component('manager-ppp-request-view', require('./views/manager/ppp-requests/PPPRequestsView.vue').default);

Vue.component('export-ppp-report-table', require('./views/manager/exports/ExportPPPReport.vue').default);
Vue.component('export-po-report-table', require('./views/manager/exports/ExportPOReport.vue').default);

