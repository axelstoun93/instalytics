import { Component, OnInit, OnDestroy, Renderer2, ElementRef } from '@angular/core';

@Component({
  selector: 'app-semi-dark-layout',
  templateUrl: './semi-dark-layout.component.html',
  styleUrls: ['./semi-dark-layout.component.scss']
})
export class SemiDarkLayoutComponent implements OnDestroy, OnInit {


  constructor(private renderer: Renderer2, private elRef: ElementRef) {
    this.renderer.addClass(document.body, '2-columns');
    this.renderer.setAttribute(document.body, 'data-col', '2-columns');
  }

  ngOnInit() {
    const el = this.elRef.nativeElement.querySelector('#stackNav')
    this.renderer.removeClass(el, 'navbar-brand-center');
    this.renderer.removeClass(el, 'navbar-dark');
    this.renderer.removeClass(el, 'bg-primary');
    this.renderer.addClass(el, 'navbar-semi-dark');
    const elm = this.elRef.nativeElement.querySelector('#stackMenu')
    this.renderer.removeClass(elm, 'menu-light');
    this.renderer.addClass(elm, 'menu-dark');
  }

  ngOnDestroy() {
    this.renderer.removeClass(document.body, '2-columns');
    const el = this.elRef.nativeElement.querySelector('#stackNav');
    this.renderer.addClass(el, 'navbar-brand-center');
    this.renderer.addClass(el, 'navbar-dark');
    this.renderer.addClass(el, 'bg-primary');
    this.renderer.removeClass(el, 'navbar-semi-dark');
    const elm = this.elRef.nativeElement.querySelector('#stackMenu')
    this.renderer.addClass(elm, 'menu-light');
    this.renderer.removeClass(elm, 'menu-dark');

  }
}


