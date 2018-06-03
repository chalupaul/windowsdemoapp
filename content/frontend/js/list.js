function makeRow(index, name) {

    var $row = $('<tr><td class="index"></td><td class="name"></td><td class="text-right"><span class="glyphicon glyphicon-user"></span></td></tr>');
    $row.find('.index').text(index);
    $row.find('.name').text(name);
    return $row;
}


function paginator(obj) {

    var paginator = {
        names: obj.names,
        page: 1,
        pageSize: obj.pageSize,
        shownPages: obj.shownPages,
        $container: obj.$container,
        onPageChange: obj.onPageChange
    }
    var self = paginator;

    self.$nav = $('<nav></nav>');
    self.$ul = $('<ul class="pagination"></ul></nav>');
    self.$nav.append(self.$ul);
    self.$container.append(self.$nav);

    self.totalPages = function() {
        return Math.ceil(self.names.length / self.pageSize);
    }

    self.pageList = function() {
        var pages = [];
        var totalPages = self.totalPages();
        var length = Math.min(self.shownPages, totalPages);
        var start = self.page - (Math.floor(length / 2));
        var stop = start + length - 1;

        if (start < 1) {
            var distance = 1 - start;
            start += distance;
            stop += distance;
        }

        if (stop > totalPages) {
            var distance = stop - totalPages;
            start -= distance;
            stop -= distance;
        }

        for (var i = start; i <= stop; i++) {
            pages.push(i);
        }
        return pages;
    };

    self.isFirst = function(page) {
        return (page == 1);
    };

    self.isActive = function(page) {
        return (page == self.page);
    };

    self.isLast = function(page) {
        return (page == self.totalPages());
    };


    self.renderPageItem = function(page, text) {
        var $li = $('<li class="page-item"></li>');
        var $link = $('<a class="page-link" href="#"></a>').attr('data-page', page);
        $link.html(text !== undefined ? text : page);
        if (self.isActive(page)) {
            $li.addClass('active');
        } else {
            $link.bind('click', function() {
                self.changePage(page);
            });
        }
        $li.append($link);
        return $li;
    };

    self.renderFirst = function() {
        var $li = self.renderPageItem(1, '&laquo;');
        if (self.page == 1) {
            $li.addClass('disabled');
        } else {
            $li.find(".page-link").bind('click', function() {
                self.changePage(1);
            });
        }
        return $li;
    };

    self.renderLast = function() {
        var last = self.totalPages();
        var $li = self.renderPageItem(last, '&raquo;');
        if (self.page == last) {
            $li.addClass('disabled');
        } else {
            $li.find(".page-link").bind('click', function() {
                self.changePage(last);
            });
        }
        return $li;
    };

    self.render = function() {
        var pages = self.pageList();

        // Empty nav html
        self.$ul.html("");

        // First quick link
        self.$ul.append(self.renderFirst());

        // Number page links
        for (var i = 0; i < pages.length; i++) {
            var $li = self.renderPageItem(pages[i]);
            self.$ul.append($li);
        }

        // Last quick link
        self.$ul.append(self.renderLast());
    };

    self.changePage = function(page) {
        self.page = Math.min(self.totalPages(), page);
        self.page = Math.max(1, page);
        self.render();
        self.onPageChange(self.page, self.pageSize);
    };

    return self;

}

function updateStatus(page, pageSize) {
    var $status = $('#status');
    var start = (page - 1) * pageSize + 1;
    var stop = Math.min(start + pageSize - 1, namesArray.length);
    $status.html('Showing <span class="status-start"></span> to <span class="status-stop"></span> of <span class="status-total"></span> names.');
    $status.find('.status-start').text(start);
    $status.find('.status-stop').text(stop);
    $status.find('.status-total').text(namesArray.length);
}


function renderNewNames(names) {
    var $ul = $('<ul></ul>');
    for (var i = 0; i < names.length; i++) {
        $ul.append($('<li>' + names[i] + '</li>'));
    }
    $('#new-names').html('').append($ul);
}

function moreNames(pager) {
    var req = {
        url: 'add10ajax.php',
        dataType: 'json',
        success: function(data) {
            renderNewNames(data.newNames);
            pager.names = data.allNames;
            namesArray = data.allNames;
            pager.changePage(pager.page);
            $('#new-names-modal').modal({});
        }
    }
    $.ajax(req);
}

$(function() {
    if (typeof(namesArray) !== 'undefined') {
        var pager = paginator({
            names: namesArray,
            pageSize: 10,
            shownPages: 5,
            $container: $('#pageContainer'),
            onPageChange: function(page, pageSize) {
                var start = (page - 1) * pageSize;
                var $tbody = $('#names-table tbody');

                // Empty table
                $tbody.html('');
                
                // Add fresh rows
                for (var i = start; i < start + pageSize; i++) {
                    $tbody.append(makeRow(i + 1, namesArray[i]));
                }
                updateStatus(page, pageSize);
            }
        });
        pager.changePage(1);
        $('#more-names').click(function() {
            moreNames(pager);
        });
    }
});
