var RequestMedicineViewModel = function()
{
    var self = this;

    self.url = '/request-medicine/json/detail';
    self.data = ko.observableArray([]);
    
    self.data({get_all_images: []});

    self.viewDetailRequestMedicine = function(data, event)
    {
        var element = event.target;
        var paramId = $(element).attr('data-id');

        var params = { request_id: paramId };
        var request = $.ajax({method: 'GET', url: self.url, data: params});

        request.done(function(data){
            self.data(data);
        });
    }
}
