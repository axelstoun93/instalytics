import { Component, OnInit } from '@angular/core';
import { ROUTES } from './navigation-routes.config';
import { RouteInfo } from "./navigation.metadata";
import { Router, ActivatedRoute } from "@angular/router";

declare var $: any;
@Component({
    // moduleId: module.id,
    selector: 'app-navigation',
    templateUrl: './navigation.component.html',
})

export class NavigationComponent implements OnInit {
    public menuItems: any[];

    constructor(private router: Router,
        private route: ActivatedRoute) {
    }

    ngOnInit() {
        $.getScript('./assets/app/js/core/app-menu.js');
        $.getScript('./assets/app/js/core/app.js');
        $.getScript('./assets/app/vendors/js/ui/jquery.sticky.js');
       
        this.menuItems = ROUTES.filter(menuItem => menuItem);
    }

}
