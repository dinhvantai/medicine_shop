var objectLinkViewModel = function() {
    var self = this;

    self.textConfirm;
    self.objectLinks = ko.observableArray([]);

    self.objectLink = function(paramKey, paramLink) {
        return {key: paramKey, link: paramLink};
    }

    self.initData = function(data, textConfirm) {
        self.objectLinks(data);
        self.textConfirm = textConfirm;
        return self;
    }

    self.addNewOption = function() {
        self.objectLinks.push(self.objectLink('', ''));
    }
    self.removeOption = function(option) {
        var valueConfirm = confirm(self.textConfirm);
        if (!valueConfirm) return;
        self.objectLinks.remove(option);
    }
}
