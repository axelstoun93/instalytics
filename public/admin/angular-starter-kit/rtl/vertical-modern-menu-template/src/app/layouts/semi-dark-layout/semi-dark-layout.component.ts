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
    const elm = this.elRef.nativeElement.querySelector('#stackMenu')
    this.renderer.removeClass(elm, 'menu-dark');
    this.renderer.addClass(elm, 'menu-light');
    const elf = this.elRef.nativeElement.querySelector('#stackFooter')
    this.renderer.removeClass(elf, 'footer-light');
    this.renderer.addClass(elf, 'footer-dark');
    const ell = this.elRef.nativeElement.querySelector('#stackLogo')
    this.renderer.setAttribute(ell, 'src', 'assets/app/images/logo/stack-logo-light.png');
  }

  ngOnDestroy() {
    this.renderer.removeClass(document.body, '2-columns');
    const elm = this.elRef.nativeElement.querySelector('#stackMenu')
    this.renderer.addClass(elm, 'menu-dark');
    this.renderer.removeClass(elm, 'menu-light');
    const elf = this.elRef.nativeElement.querySelector('#stackFooter')
    this.renderer.addClass(elf, 'footer-light');
    this.renderer.removeClass(elf, 'footer-dark');
  }
}


