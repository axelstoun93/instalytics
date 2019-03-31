import { Component, OnInit, ElementRef, Renderer2, OnDestroy } from '@angular/core';

@Component({
  selector: 'app-light-layout',
  templateUrl: './light-layout.component.html',
  styleUrls: ['./light-layout.component.scss']
})
export class LightLayoutComponent implements OnDestroy, OnInit  {
  
    
    constructor(private renderer: Renderer2, private elRef: ElementRef) {
      this.renderer.addClass(document.body, '2-columns'); 
      this.renderer.setAttribute(document.body, 'data-col', '2-columns');
     }
  
     ngOnInit() {
      
     }
  
    ngOnDestroy() {
      this.renderer.removeClass(document.body, '2-columns');
    }
  }
  
