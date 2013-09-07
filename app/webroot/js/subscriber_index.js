$(document).ready(function(){

    var w = window.location;

    $('#subscriberSearch').select2({
        placeholder: 'Search by msisdn',
        minimumInputLength: 8,
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
                return {results: data.subscribers, more: more};
            }
        }
    });

    $('#subscriberSearch').change(function(){
        //alert($(this).val());
        //console.log()
        window.location = w.pathname + '/view/' + $(this).val();
    });
});
