$(document).ready(function(){
    var w = window.location;
    $('#campaignSearch').select2({
        placeholder: 'Search by title',
        minimumInputLength: 3,
        ajax: {
            url: w.pathname + '/search/',
            dataType: 'json',
            quietMillis: 100,
            data: function(term, page){
                    //return param = 'q=' + term + '&page=' + page + '&page_limit=' + 3;
                return {
                    q: term,
                    page_limit: 10,
                    page: page
                };
            },
            results: function(data, page){
                //console.log(page);
                //console.log(data.total);
                var more = (page * 10) < data.total;
                return {results: data.campaigns, more: more};
            }
        }
    });

    $('#campaignSearch').change(function(){
        //alert($(this).val());
        window.location = w.pathname + '/view/' + $(this).val(); 
    });


});
