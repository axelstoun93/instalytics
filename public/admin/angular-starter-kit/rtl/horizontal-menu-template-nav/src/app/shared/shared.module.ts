import { NgModule } from '@angular/core';
 import { CommonModule } from "@angular/common";
 import { RouterModule } from "@angular/router";

 import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { FooterComponent } from "./footer/footer.component";
import { NavbarComponent } from "./navbar/navbar.component";
import { NavigationComponent } from "./navigation/navigation.component";
import { ToggleFullscreenDirective } from "./directives/toggle-fullscreen.directive";



@NgModule({
    exports: [
        CommonModule,
        FooterComponent,
        NavbarComponent,
        NavigationComponent,
        ToggleFullscreenDirective,
        NgbModule
    ],
    imports:[
        RouterModule,
        CommonModule,
        NgbModule
    ],
    declarations: [
        FooterComponent,
        NavbarComponent,
        NavigationComponent,
        ToggleFullscreenDirective
        ]
})
export class SharedModule { }
