var PrescriptionViewModel = function()
{
    var self = this;

    self.url = '/prescription/json/getList';
    self.currentPage = ko.observable(1);
    self.totalPage = ko.observable();
    self.prescriptionDataArray = ko.observableArray([]);
    self.prescriptionDetail = ko.observableArray();
    self.statusItem = [];

    self.completeLoadData = function(data)
    {
        self.currentPage(data.current_page);
        self.prescriptionDataArray(data.data);
        $('.indicator').addClass('hide');
    }

    self.initData = function(statusItem)
    {
        $('.indicator').removeClass('hide');

        var tmpDetail = {get_all_item_prescriptions: [], get_doctor: {}};
        self.prescriptionDetail(tmpDetail);
        self.statusItem = statusItem;

        var params = { page: self.currentPage() };
        var request = $.ajax({method: "GET", url: self.url, data: params});

        request.done(function(data){
            self.totalPage(data.last_page);
            self.completeLoadData(data);
        });
        request.fail(function(jqXHR, textStatus){
            $('.indicator').addClass('hide');
        });

        return self;
    }

    self.nextPage = function()
    {
        $('.indicator').removeClass('hide');

        var currentPage = self.currentPage();
        if (currentPage < self.totalPage()){
            self.currentPage(++currentPage);
        }
       
        var params = { page: self.currentPage() };

        var request = $.ajax({method: "GET", url: self.url, data: params});
        request.done(function(data){
            self.completeLoadData(data);
        });
        request.fail(function(jqXHR, textStatus){
            $('.indicator').addClass('hide');
        });
    }

    self.prePage = function()
    {
        $('.indicator').removeClass('hide');

        var currentPage = self.currentPage();
        if (currentPage > 1){
            self.currentPage(--currentPage);
        }
        
        var params = { page: self.currentPage() };
        var request = $.ajax({method: "GET", url: self.url, data: params});

        request.done(function(data){
            self.completeLoadData(data);
        });
        request.fail(function(jqXHR, textStatus){
            $('.indicator').addClass('hide');
        });
    }

    self.viewDetailPrescription = function(data, event)
    {
        self.prescriptionDetail(data);
    }
}

var itemPrescription = function(data)
{
    var self = this;

    self.urlSearch = '/prescription/json/searchMedicines';
    self.resultFindMedicines = ko.observableArray([]);
    self.selectedMedicine = ko.observable();
    self.medicineName = ko.observable(data.name_medicine);
    self.itemId = ko.observable(data.id);
    self.medicineId = ko.observable(data.medicine_id);
    self.amout = ko.observable(data.amount);
    self.qty_purchased = ko.observable(data.qty_purchased);
    self.item_guide = ko.observable(data.guide);
    self.unitMedicine = ko.observable();

    if (data.get_medicine) {
        self.unitMedicine(data.get_medicine.unit);
    }

    self.findMedicineKeyup = function(object, event)
    {
        $('#over-medicine-full-screen').removeClass('hide');

        var elementParent = $(event.target).parent();
        var paramKeyword = event.target.value;

        var params = {keyword: paramKeyword};
        var request = $.ajax({method: "GET", url: self.urlSearch, data: params});

        var elementShowMedicine = elementParent.find('.prescrition-search-item');
        elementShowMedicine.removeClass('hide');

        request.done(function(data){
            self.resultFindMedicines(data);
        });
    }

    self.clickSelectedMedicine = function(data, event)
    {
        self.selectedMedicine(data);
        self.medicineName(data.name);
        self.medicineId(data.id);
        self.unitMedicine(data.unit);

        var children = $(event.target).parent().children();
        children.removeClass('active');
        $(event.target).addClass('active');
        $(event.target).parent().parent().addClass('hide');
        $('#over-medicine-full-screen').addClass('hide');
    }

    self.closeNotFoundMedicine = function(data, event)
    {
        
        $('.prescrition-search-item').addClass('hide');
        $('#over-medicine-full-screen').addClass('hide');
        self.medicineId(null);
        self.unitMedicine('');
    }
}

var AddPrescriptionViewModel = function()
{
    var self = this;

    self.textComfirm;
    self.items = ko.observableArray([]);

    self.initData = function(dataArr, textComfirm)
    {   
        for (i in dataArr) {
            self.items.push(new itemPrescription(dataArr[i]));
        }
        
        self.textComfirm = textComfirm;
        return self;
    }
    self.addNewItem = function()
    {
        self.items.push(new itemPrescription({}));
    }
    self.deleteItem = function(data, event)
    {
        swal({
            title: self.textComfirm,
            type: 'info',
            showCancelButton: true,
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        },
        function(isConfirm) {
            if (isConfirm) {
                self.items.remove(data);
            } else {
                return false;
            }
        });
    }
}
