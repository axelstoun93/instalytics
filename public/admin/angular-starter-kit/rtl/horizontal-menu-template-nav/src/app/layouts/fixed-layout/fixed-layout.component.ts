import { Component, OnInit, OnDestroy, Renderer2, ElementRef } from '@angular/core';

@Component({
  selector: 'app-fixed-layout',
  templateUrl: './fixed-layout.component.html',
  styleUrls: ['./fixed-layout.component.scss']
})
export class FixedLayoutComponent implements OnDestroy, OnInit {
  
    constructor(private renderer: Renderer2, private elRef: ElementRef) {
      this.renderer.addClass(document.body, '2-columns');
      this.renderer.setAttribute(document.body, 'data-col', '2-columns');
     }

     ngOnInit() {
      const el = this.elRef.nativeElement.querySelector('#stackNav')
      this.renderer.removeClass(el, 'navbar-static-top');
      this.renderer.addClass(el, 'fixed-top');
      const elm = this.elRef.nativeElement.querySelector('#stackMenu')
      this.renderer.removeClass(elm, 'navbar-light');
      this.renderer.addClass(elm, 'navbar-dark');
      
     }
  
    ngOnDestroy() {
      this.renderer.removeClass(document.body, '2-columns');
      const el = this.elRef.nativeElement.querySelector('#stackNav')
      this.renderer.addClass(el, 'navbar-static-top');
      this.renderer.removeClass(el, 'fixed-top');
    }
  
  }
  
