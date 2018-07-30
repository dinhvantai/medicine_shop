var DoctorListViewModel = function()
{
    var self = this;

    self.url = '/doctor/json/getList';
    self.currentPage = ko.observable(1);
    self.totalPage = ko.observable(0);
    self.doctorDataArray = ko.observableArray([]);
    self.doctorDetail = ko.observableArray();
    self.keyword = ko.observable();
    self.genderOption = [];

    self.completeLoadData = function(data)
    {
        self.currentPage(data.current_page);
        self.doctorDataArray(data.data);
        $('#doctor-count-doctor').text(data.total);
        $('#doctor-list-indicator').addClass('hide');
    }

    self.getLabelGender = function(key)
    {
        if (self.genderOption[key]) return self.genderOption[key];
        return 'Not selected';
    }

    self.getLinkProfileUser = function(user_id, name)
    {
        return '/user/'+ user_id + '/' + str_slug(name);
    }

    self.getLinkAvatarUser = function(path)
    {
        if (!path) return '/images/no-avatar.png';
        if (path.search('http') != -1) return path;
        return '/' + path;
    }

    self.initData = function(genderOption)
    {
        $('#doctor-list-indicator').removeClass('hide');

        self.genderOption = genderOption;

        var params = { page: self.currentPage() };
        var request = $.ajax({method: 'GET', url: self.url, data: params});

        request.done(function(data){
            self.totalPage(data.last_page);
            self.completeLoadData(data);
        });
        request.fail(function(jqXHR, textStatus){
            $('#doctor-list-indicator').addClass('hide');
        });

        return self;
    }

    self.keyupDoctorSeach = function(data, event)
    {
        $('#doctor-list-indicator').removeClass('hide');
        self.keyword($(event.target).val());
        var params = { page: self.currentPage(), keyword: self.keyword() };
        var request = $.ajax({method: 'GET', url: self.url, data: params});

        request.done(function(data){
            self.totalPage(data.last_page);
            self.completeLoadData(data);
        });

        request.fail(function(jqXHR, textStatus){
            $('#doctor-list-indicator').addClass('hide');
        });
    }

    self.nextPage = function()
    {
        $('#doctor-list-indicator').removeClass('hide');

        var currentPage = self.currentPage();
        if (currentPage < self.totalPage()){
            self.currentPage(++currentPage);
        }
       
        var params = { page: self.currentPage(), keyword: self.keyword() };

        var request = $.ajax({method: 'GET', url: self.url, data: params});
        request.done(function(data){
            self.completeLoadData(data);
        });
        request.fail(function(jqXHR, textStatus){
            $('#doctor-list-indicator').addClass('hide');
        });
    }

    self.prePage = function()
    {
        $('#doctor-list-indicator').removeClass('hide');

        var currentPage = self.currentPage();
        if (currentPage > 1){
            self.currentPage(--currentPage);
        }
        
        var params = { page: self.currentPage(), keyword: self.keyword() };
        var request = $.ajax({method: 'GET', url: self.url, data: params});

        request.done(function(data){
            self.completeLoadData(data);
        });
        request.fail(function(jqXHR, textStatus){
            $('#doctor-list-indicator').addClass('hide');
        });
    }

    self.viewDetailDoctor = function(data, event)
    {
        self.doctorDetail(data);
    }
}
