var CommentData = function(object)
{
    this.itemData = ko.observableArray([]);
    this.childrenItems = ko.observableArray([]);

    this.itemData(object);
    this.childrenItems(object.get_children_comment);
}

var CommentViewModel = function()
{
    var self = this;

    self.url = '/comment/json/getList';
    self.medicineId = ko.observable();
    self.currentPage = ko.observable(1);
    self.totalPage = ko.observable();
    self.commentDataArray = ko.observableArray([]);
    self.currentUserId = ko.observable(0);
    self.optionPermission = ko.observableArray([]);

    self.completeLoadData = function(data)
    {
        self.currentPage(data.comments.current_page);
        self.totalPage(data.comments.last_page);
        self.currentUserId(data.currentUserId);
        self.optionPermission(data.optionPermission);

        var dataItems = [];
        for (i in data.comments.data) {
            dataItems.push(new CommentData(data.comments.data[i]));
        }
        self.commentDataArray(dataItems);
        $('#comment-indicator').addClass('hide');
    }

    self.initData = function(paramMedicineId)
    {
        $('#comment-indicator').removeClass('hide');
        
        self.medicineId(paramMedicineId);
        var params = { page: self.currentPage(), medicineId: paramMedicineId };
        var request = $.ajax({method: "GET", url: self.url, data: params});

        request.done(function(data){
            self.totalPage(data.comments.last_page);
            self.completeLoadData(data);
        });
        request.fail(function(jqXHR, textStatus){
            $('#comment-indicator').addClass('hide');
        });

        return self;
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

    self.getLabelPermission = function(id)
    {
        return self.optionPermission()[id];
    }

    self.showEmptyContent = function()
    {
        $('#comment-indicator').addClass('hide');
        $('#comment-indicator-add-question').addClass('hide');
        swal('Please enter text to question or answer!');
    }

    self.sendComment = function(data, event)
    {
        var paramUrl = '/comment/send/data';
        $('#comment-indicator-add-question').removeClass('hide');

        var paramContent = $('#comment-content-textarea').val();
        if (!paramContent) {
            $('#comment-content-textarea').focus();
            self.showEmptyContent();
            return;
        }

        $('#comment-content-textarea').val('');

        var tokenParam = $('meta[name=_token]').attr('content');
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : tokenParam }
        });

        var params = {page: self.currentPage(), medicineId: self.medicineId(), content: paramContent };
        
        var request = $.ajax({method: 'POST', url: paramUrl, data: params});
        request.done(function(data){
            self.completeLoadData(data);
            $('#comment-indicator-add-question').addClass('hide');
        });
        request.fail(function(jqXHR, textStatus){
            $('#comment-indicator').addClass('hide');
            $('#comment-content-textarea').val(paramContent);
            $('#comment-indicator-add-question').addClass('hide');
        });
    }

    self.nextPage = function()
    {
        $('#comment-indicator').removeClass('hide');

        var currentPage = self.currentPage();
        if (currentPage < self.totalPage()){
            self.currentPage(++currentPage);
        }
       
        var params = { page: self.currentPage(), medicineId: self.medicineId() };

        var request = $.ajax({method: "GET", url: self.url, data: params});
        request.done(function(data){
            self.completeLoadData(data);
        });
        request.fail(function(jqXHR, textStatus){
            $('#comment-indicator').addClass('hide');
        });
    }

    self.prePage = function()
    {
        $('#comment-indicator').removeClass('hide');

        var currentPage = self.currentPage();
        if (currentPage > 1){
            self.currentPage(--currentPage);
        }
        
        var params = { page: self.currentPage(), medicineId: self.medicineId() };
        var request = $.ajax({method: "GET", url: self.url, data: params});

        request.done(function(data){
            self.completeLoadData(data);
        });
        request.fail(function(jqXHR, textStatus){
            $('#comment-indicator').addClass('hide');
        });
    }

    self.saveParentComment = function(data, event)
    {
        var paramUrl = '/comment/send/data';

        var itemId = data.itemData().id;
        $('#comment-parent-indicator-edit-' + itemId).removeClass('hide');

        var paramContent = $('#cm-parent-textarea-' + itemId).val();

        if (!paramContent) {
            $('#comment-parent-indicator-edit-' + itemId).addClass('hide');
            self.showEmptyContent();
            return;
        }

        var tokenParam = $('meta[name=_token]').attr('content');
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : tokenParam }
        });

        var params = {page: self.currentPage(), medicineId: self.medicineId(), content: paramContent, id: itemId};
        
        var request = $.ajax({method: 'POST', url: paramUrl, data: params});
        request.done(function(data){
            self.completeLoadData(data);
            $('#comment-parent-indicator-edit-' + itemId).addClass('hide');
        });
        request.fail(function(jqXHR, textStatus){
            $('#comment-parent-indicator-edit-' + itemId).addClass('hide');
            $('#comment-content-textarea').val(paramContent);
        });
    }

    self.editParentComment = function(data, event)
    {
        if (data.itemData().user_id != self.currentUserId()) return;

        var itemId = data.itemData().id;
        $('#cm-show-parent-' + itemId).addClass('hide')
        $('#cm-parent-textarea-' + itemId).removeClass('hide');
        $('#cm-parent-textarea-' + itemId).val(data.itemData().content);
        $('#cm-parent-textarea-' + itemId).focus();
        $('#cm-parent-button-edit-' + itemId).addClass('hide');
        $('#cm-parent-button-save-' + itemId).removeClass('hide');
    }

    self.pressEscParentComment = function(data, event)
    {
        // Press ESC
        if (event.keyCode === 27) {
            var itemId = data.itemData().id;
            $('#cm-show-parent-' + itemId).removeClass('hide')
            $('#cm-parent-textarea-' + itemId).addClass('hide');
            $('#cm-parent-button-edit-' + itemId).removeClass('hide');
            $('#cm-parent-button-save-' + itemId).addClass('hide');
        }
    }

    self.addChidrenComment = function(data, event)
    {
        var paramUrl = '/comment/send/data/children';
        var itemId = data.itemData().id;

        var paramContent = $('#cm-children-input-' + itemId).val();
        if (!paramContent) {
            self.showEmptyContent();
            return;
        }

        $('#comment-children-indicatora-' + itemId).removeClass('hide');
        $('#cm-children-input-' + itemId).val('');

        var tokenParam = $('meta[name=_token]').attr('content');
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : tokenParam }
        });

        var params = {medicineId: self.medicineId(), content: paramContent, parent_id: itemId};
        
        var request = $.ajax({method: 'POST', url: paramUrl, data: params});
        request.done(function(result){
            data.childrenItems(result);
            $('#comment-children-indicatora-' + itemId).addClass('hide');
        });
        request.fail(function(jqXHR, textStatus){
            $('#comment-content-textarea').val(paramContent);
            $('#comment-children-indicatora-' + itemId).addClass('hide');
        });
    }

    self.enterAddChildrenComment = function (data, event)
    {  
        if (event.keyCode === 13) {
            self.addChidrenComment(data, event);
        }
        
    }

    self.enterEditChildrenComment = function(data, event)
    {   
        // Press Enter
        if (event.keyCode === 13) {
            self.saveChildrenComment(data, event);
        }

        // Press ESC
        if (event.keyCode === 27) {
            var comment_id = data.id;
            $('#cm-children-show-content-' + comment_id).removeClass('hide');
            $('#cm-children-area-edit-' + comment_id).addClass('hide');
        }
    }

    self.saveChildrenComment = function(data, event)
    {
        var paramUrl = '/comment/send/data/children';
        var comment_id = data.id;
        var itemId = data.parent_id;
        var paramContent = $('#cm-children-area-edit-' + comment_id).find('input').val();
        if (!paramContent) {
            self.showEmptyContent();
            return;
        }
        $('#comment-children-indicatora-update-' + comment_id).removeClass('hide');

        var tokenParam = $('meta[name=_token]').attr('content');
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : tokenParam }
        });
        var params = {medicineId: self.medicineId(), parent_id: itemId, id: comment_id, content: paramContent};
        var request = $.ajax({method: 'POST', url: paramUrl, data: params});
        request.done(function(result){
            var dataTmp = self.commentDataArray();
            for (var key in dataTmp) {
                if (dataTmp[key].itemData().id == itemId) {
                    dataTmp[key].childrenItems(result);
                    break;
                }
            }
            $('#comment-children-indicatora-update-' + comment_id).addClass('hide');
        });
        request.fail(function(jqXHR, textStatus){
            $('#comment-children-indicatora-update-' + comment_id).addClass('hide');
        });
    }

    self.editChildrenComment = function(data, event)
    {
        var comment_id = data.id;
        if (data.user_id != self.currentUserId()) return;
        $('#cm-children-area-edit-' + comment_id).removeClass('hide');
        $('#cm-children-show-content-' + comment_id).addClass('hide');
        $('#cm-children-area-edit-' + comment_id).find('input').val(data.content);
        $('#cm-children-area-edit-' + comment_id).find('input').focus();
        // $(event.target).addClass('hide');
    }

    self.deleteChildrenComment = function(data, event)
    {
        var paramUrl = '/comment/delete/children';

        swal({
            title: 'Do you want to delete?',
            type: 'info',
            showCancelButton: true,
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }, function(isConfirm) {
            if (isConfirm) {
                var comment_id = data.id;
                var itemId = data.parent_id;
                $('#comment-children-indicatora-update-' + comment_id).removeClass('hide');
                var tokenParam = $('meta[name=_token]').attr('content');
                $.ajaxSetup({
                   headers: { 'X-CSRF-Token' : tokenParam }
                });
                var params = {medicineId: self.medicineId(), parent_id: itemId, id: comment_id};
                var request = $.ajax({method: 'POST', url: paramUrl, data: params});
                request.done(function(result){
                    var dataTmp = self.commentDataArray();
                    for (var key in dataTmp) {
                        if (dataTmp[key].itemData().id == itemId) {
                            dataTmp[key].childrenItems(result);
                            break;
                        }
                    }
                    $('#comment-children-indicatora-update-' + comment_id).addClass('hide');
                });
                request.fail(function(jqXHR, textStatus){
                    $('#comment-children-indicatora-update-' + comment_id).addClass('hide');
                });

            } else {
                swal('Cancelled', '', 'error');
                return false;
            }
        });
    }
}
