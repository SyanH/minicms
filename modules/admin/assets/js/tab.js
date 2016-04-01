/* 
  intabs.jquery.js * a simple jQuery plugin for tabbed content
  http://github.com/lukasztyrala/intabs
  
  The MIT License

  Copyright (c) 2010 Lukasz Tyrala
  
  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:
  
  The above copyright notice and this permission notice shall be included in
  all copies or substantial portions of the Software.
  
  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
  THE SOFTWARE.
*/

jQuery.fn.intabs = function(options) {

  return this.each(function() {

    var settings = {
      starting_tab: 0,
      tab_element: '.tabs li',
      section_element: '.tabbed',
      no_tab_class: '.normal',
      current_class: 'current',
      triggering_event: 'click' 
    };
    
    if (options) { 
      jQuery.extend(settings, options);
    }

    var st = settings.starting_tab;
    var te = settings.tab_element;
    var se = settings.section_element;
    var ntc = settings.no_tab_class;
    var cc = settings.current_class;
    var tev = settings.triggering_event;

    var ne = $(this).find(te).not(ntc);
    var ss = $(this).find(se);
    var sss = ss.eq(st);
    var nes = ne.eq(st);

    ss.hide();
    sss.show();
    ne.addClass('');
    nes.addClass(cc);

    ne.bind(tev, function() {
      var nav_index = ne.index(this);
      ss.hide();
      ss.eq(nav_index).show();
      ne.removeClass(cc);
      ne.eq(nav_index).addClass(cc);
      return false;
     });
 });

};