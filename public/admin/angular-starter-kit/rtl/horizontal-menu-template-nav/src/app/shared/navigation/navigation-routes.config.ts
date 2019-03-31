import { RouteInfo } from './navigation.metadata';

export const ROUTES: RouteInfo[] = [

    {
        path: '', title: 'Layouts', icon: 'ft-zap', class: 'dropdown nav-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false,
        submenu: [
            { path: '/1-column-layout', title: '1 column', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            {
                path: '', title: 'Content Det. Sidebar', icon: '', class: 'dropdown dropdown-submenu', badge: '', badgeClass: '', isExternalLink: false, isDivider: false,
                submenu: [
                    { path: '/detached-left-sidebar-layout', title: 'Detached left sidebar', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
                    { path: '/detached-sticky-left-sidebar-layout', title: 'Detached sticky left sidebar', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
                    { path: '/detached-right-sidebar-layout', title: 'Detached right sidebar', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
                    { path: '/detached-sticky-right-sidebar-layout', title: 'Detached sticky right sidebar', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
                ]
            },
            { path: '', title: '', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: true, submenu: [] },
            { path: '/fixed-navigation-layout', title: 'Fixed navigation', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '', title: '', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: true, submenu: [] },
            { path: '/fixed-layout', title: 'Fixed layout', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/boxed-layout', title: 'Boxed layout', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/static-layout', title: 'Static layout', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '', title: '', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: true, submenu: [] },
            { path: '/light-layout', title: 'Light layout', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/dark-layout', title: 'Dark layout', icon: '', class: 'menu-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
        ]
    },
    {
        path: '', title: 'Components', icon: 'ft-box', class: 'dropdown nav-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false,
        submenu: [
            { path: '/components/accordion', title: 'Accordion', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/alerts', title: 'Alerts', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/buttons', title: 'Buttons', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/carousel', title: 'Carousel', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/collapse', title: 'Collapse', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/datepicker', title: 'Datepicker', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/dropdowns', title: 'Dropdowns', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/models', title: 'Modals', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/pagination', title: 'Pagination', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/popover', title: 'Popover', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/progress', title: 'Progress Bars', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/rating', title: 'Rating', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/tabs', title: 'Tabs', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/timepicker', title: 'Timepicker', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/tooltip', title: 'Tooltip', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
            { path: '/components/typeahead', title: 'Typeahead', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] }
        ]
    },
    {
        path: '', title: 'Menu Levels', icon: 'ft-align-left', class: 'dropdown nav-item', badge: '5', badgeClass: 'badge badge badge-primary badge-pill float-right mr-2', isExternalLink: false, isDivider: false,
        submenu: [
            { path: 'javascript:;', title: 'Second Level', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: true, isDivider: false, submenu: [] },
            {
                path: '', title: 'Second Level Child', icon: '', class: 'dropdown dropdown-submenu', badge: '', badgeClass: '', isExternalLink: false, isDivider: false,
                submenu: [
                    { path: 'javascript:;', title: 'Third Level 1.1', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
                    { path: 'javascript:;', title: 'Third Level 1.2', icon: '', class: 'dropdown-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: [] },
                ]
            },
        ]
    },
    {
        path: '/changelog', title: 'ChangeLog', icon: 'ft-file', class: 'nav-item', badge: '', badgeClass: '', isExternalLink: false, isDivider: false, submenu: []
    },
    { path: 'https://pixinvent.ticksy.com/', title: 'Raise Support', icon: 'ft-life-buoy', class: 'nav-item', badge: '', badgeClass: '', isExternalLink: true, isDivider: false, submenu: [] },
    { path: 'https://pixinvent.com/stack-bootstrap-admin-template/documentation', title: 'Documentation', icon: 'ft-folder', class: 'nav-item', badge: '', badgeClass: '', isExternalLink: true, isDivider: false, submenu: [] },


];
