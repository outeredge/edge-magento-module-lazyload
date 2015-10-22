jQuery.fn.lazyload = function(pages, triggerHeight, toolbar){

    jQuery(toolbar).hide();

    var el = this.selector,
        grid = jQuery(el),
        page = 2,
        url = (window.location.origin || (window.location.protocol + '//' + window.location.hostname)) + window.location.pathname,
        lazyloading = false;

    function getQuery()
    {
        return document.location.search.replace(/(^\?)/,'').split("&").map(function(n){return n = n.split("="),this[n[0]] = n[1],this}.bind({}))[0];
    }

    function atTriggerPoint()
    {
        var triggerPoint = jQuery(el).get(0).getBoundingClientRect().bottom - jQuery(window).height();
        return triggerPoint < triggerHeight;
    }

    function lazyloadProducts()
    {
        if(lazyloading || page > pages)
            return;

        var params = getQuery();
        params.p = page;

        lazyloading = true;

        jQuery.get(url, params)
            .done(function(response){
                grid.append(jQuery(jQuery.parseHTML(response)).find(el).html());
                page++;
                lazyloading = false;
            });
    }

    jQuery(window).scroll(function(){
        if(atTriggerPoint())
            lazyloadProducts();
    }).trigger('scroll');
};
