var RequestPrescriptionViewModel = function()
{
    var self = this;

    self.url = '/request-prescription/json/detail';
    self.urlDoctor = '/request-prescription/json/doctorDetail';
    self.data = ko.observableArray([]);
    
    self.data({get_all_images: [], get_user: {display_name: ''}});

    self.viewDetailRequestPrescription = function(data, event)
    {
        var element = event.target;
        var paramId = $(element).attr('data-id');

        var params = { request_id: paramId };
        var request = $.ajax({method: 'GET', url: self.url, data: params});

        request.done(function(data){
            self.data(data);
        });
    }

    self.viewDetailRequestPrescriptionDoctor = function(data, event)
    {
        var element = event.target;
        var paramId = $(element).attr('data-id');

        var params = { request_id: paramId };
        var request = $.ajax({method: 'GET', url: self.urlDoctor, data: params});

        request.done(function(data){
            self.data(data.data);
            $('.count-new-request-doctor').html(data.countRequest);
        });
    }
}
