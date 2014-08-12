'use strict';

angular.module('app.controllers', [])
    .controller('tablo', function($scope) {
        $scope.day = {"header":"\u0420\u0430\u0441\u043f\u0438\u0441\u0430\u043d\u0438\u0435 \u043d\u0430 \u0447\u0435\u0442\u0432\u0435\u0440\u0433","table":{"headers":["1-\u0439 \u0443\u0440\u043e\u043a","2-\u0439 \u0443\u0440\u043e\u043a","3-\u0439 \u0443\u0440\u043e\u043a","4-\u0439 \u0443\u0440\u043e\u043a","5-\u0439 \u0443\u0440\u043e\u043a","6-\u0439 \u0443\u0440\u043e\u043a","7-\u0439 \u0443\u0440\u043e\u043a"],"rows":{"0":{"group":"8\u0410","lessons":[[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"201"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"201"}],[{"name":"\u0420\u0443\u0441\u0441\u043a\u0438\u0439","auditorium":"302"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u041e\u0431\u0449\u0435\u0441\u0442\u0432\u043e","auditorium":"302"}],[{"name":"\u0418\u043d\u0444\u043e\u0440\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"209"},{"name":"\u0418\u043d\u0444\u043e\u0440\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"210"}],[{"name":"","auditorium":""}]]},"1":{"group":"9А","lessons":[[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u041e\u0431\u0449\u0435\u0441\u0442\u0432\u043e","auditorium":"306"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"306"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"306"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"306"}],[{"name":"\u0418\u041c\u041a","auditorium":"104"}],[{"name":"\u0424\u0438\u0437\u043a\u0443\u043b\u044c\u0442\u0443\u0440\u0430","auditorium":""}]]},"2":{"group":"9\u0411","lessons":[[{"name":"\u041e\u0431\u0449\u0435\u0441\u0442\u0432\u043e","auditorium":"212"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"212"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"201"},{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"212"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"201"},{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"212"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"212"},{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"304"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"212"},{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"304"}]]},"3":{"group":"9\u0412","lessons":[[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"109"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"109"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u041e\u0431\u0449\u0435\u0441\u0442\u0432\u043e","auditorium":"109"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"109"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"109"}],[{"name":"\u0424\u0438\u0437\u043a\u0443\u043b\u044c\u0442\u0443\u0440\u0430","auditorium":""}]]},"4":{"group":"10\u0410","lessons":[[{"name":"\u0418\u0441\u0442\u043e\u0440\u0438\u044f\u0414\u0440\u0412\u0440","auditorium":"303"}],[{"name":"\u0418\u0441\u0442\u043e\u0440\u0438\u044f\u0414\u0440\u0412\u0440","auditorium":"303"}],[{"name":"\u0420\u0443\u0441\u0441\u043a\u0438\u0439","auditorium":"303"}],[{"name":"\u0420\u0443\u0441\u0441\u043a\u0438\u0439","auditorium":"303"}],[{"name":"\u0418\u041c\u041a","auditorium":"104"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"","auditorium":""}]]},"5":{"group":"10\u0411","lessons":[[{"name":"\u0418\u043d\u0444\u043e\u0440\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"209"},{"name":"\u0418\u043d\u0444\u043e\u0440\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"206"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"305"}],[{"name":"\u0414\u0421\u0444\u041e\u0431\u0449","auditorium":"310"}],[{"name":"\u0418\u0441\u0442\u043e\u0440\u0438\u044f","auditorium":"310"}],[{"name":"\u0418\u043d\u0444\u043e\u0440\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"206"},{"name":"\u0418\u043d\u0444\u043e\u0440\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"209"}],[{"name":"\u041e\u0431\u0449\u0435\u0441\u0442\u0432\u043e","auditorium":"305"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}]]},"6":{"group":"10\u0412","lessons":[[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"106"},{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"200"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"106"},{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"200"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"200"},{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"106"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"200"},{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"106"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"106"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"106"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}]]},"7":{"group":"10\u0413","lessons":[[{"name":"\u0424\u0438\u0437\u043a\u0443\u043b\u044c\u0442\u0443\u0440\u0430","auditorium":""}],[{"name":"\u0424\u0438\u0437\u043a\u0443\u043b\u044c\u0442\u0443\u0440\u0430","auditorium":""}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"305"},{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"116"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"305"},{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"116"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"116"},{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"305"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"200"},{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"305"}]]},"8":{"group":"10\u0415","lessons":[[{"name":"","auditorium":""}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"308"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"308"}],[{"name":"\u0418\u0441\u0442\u043e\u0440\u0438\u044f","auditorium":"308"}],[{"name":"\u0418\u0441\u0442\u043e\u0440\u0438\u044f","auditorium":"308"}],[{"name":"\u0411\u0438\u043e\u043b\u043e\u0433\u0438\u044f","auditorium":"116"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}]]},"9":{"group":"10\u0417","lessons":[[{"name":"\u0424\u0438\u0437\u043a\u0443\u043b\u044c\u0442\u0443\u0440\u0430","auditorium":""}],[{"name":"\u0424\u0438\u0437\u043a\u0443\u043b\u044c\u0442\u0443\u0440\u0430","auditorium":""}],[{"name":"\u0418\u041c\u041a","auditorium":"104"}],[{"name":"\u0414\u0421\u0444\u041e\u0431\u0449","auditorium":"104"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"310"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"310"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}]]},"10":{"group":"10\u0418","lessons":[[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"307"},{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"301"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"307"},{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"301"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"307"}],[{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"301"},{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"307"}],[{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"301"},{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"307"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"307"}]]},"11":{"group":"10\u041a","lessons":[[{"name":"","auditorium":""}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"202"},{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"304"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"202"},{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"304"}],[{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"304"},{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"202"}],[{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"304"},{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"202"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"","auditorium":""}]]},"20":{"group":"8\u041b","lessons":[[{"name":"\u0411\u0438\u043e\u043b\u043e\u0433\u0438\u044f","auditorium":"221"}],[{"name":"\u0411\u0438\u043e\u043b\u043e\u0433\u0438\u044f","auditorium":"221"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"221"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u0420\u0443\u0441\u0441\u043a\u0438\u0439","auditorium":"221"}],[{"name":"\u0420\u0443\u0441\u0441\u043a\u0438\u0439","auditorium":"221"}],[{"name":"","auditorium":""}]]},"21":{"group":"8\u0421","lessons":[[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"222"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"222"}],[{"name":"\u0411\u0438\u043e\u043b\u043e\u0433\u0438\u044f","auditorium":"222"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"222"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"301"}],[{"name":"","auditorium":""}]]},"22":{"group":"9\u041b","lessons":[[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"220"}],[{"name":"\u0414\u0421\u0444\u041e\u0431\u0449","auditorium":"220"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"220"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"220"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"220"}],[{"name":"","auditorium":""}]]},"23":{"group":"10\u041b","lessons":[[{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"315"}],[{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"315"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"315"},{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"204"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"315"},{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"204"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"204"},{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"315"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"204"},{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"315"}]]},"24":{"group":"10\u041c","lessons":[[{"name":"\u0414\u0421\u0444\u041e\u0431\u0449","auditorium":"314"}],[{"name":"\u0418\u041c\u041a","auditorium":"104"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"314"}],[{"name":"\u041b\u0438\u0442\u0435\u0440\u0430\u0442\u0443\u0440\u0430","auditorium":"314"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u0418\u0441\u0442\u043e\u0440\u0438\u044f","auditorium":"314"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"314"}]]},"25":{"group":"10\u0421","lessons":[[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"313"}],[{"name":"\u041c\u0430\u0442\u0435\u043c\u0430\u0442\u0438\u043a\u0430","auditorium":"313"}],[{"name":"\u0424\u0438\u0437\u0438\u043a\u0430","auditorium":"313"}],[{"name":"\u0425\u0438\u043c\u0438\u044f","auditorium":"313"}],[{"name":"\u0410\u043d\u0433\u043b\u0438\u0439\u0441\u043a\u0438\u0439","auditorium":""}],[{"name":"\u0418\u0441\u0442\u043e\u0440\u0438\u044f","auditorium":"313"}],[{"name":"","auditorium":""}]]}}},"free_auditoriums":[["104","107","105","211","302","304","305","306","308","309","310","116","117","127","219","311","312"],["107","105","211","212","302","309","310","116","117","127","219","311","312","314"],["107","109","105","201","211","301","309","117","127","219","311","312"],["107","105","211","302","309","117","127","219","220","221","311","312"],["107","105","200","211","303","309","117","127","219","222","311","312","313","314","315"],["107","105","200","201","211","302","303","306","307","308","309","117","127","219","222","311","312"],["104","106","107","109","105","201","211","301","302","303","306","308","309","310","116","117","127","219","220","221","222","311","312","313"]]};
        var rowsObj = $scope.day.table.rows;
        var rows = [];
        for (var i in rowsObj) {
            if (rowsObj.hasOwnProperty(i)){
                rows.push(rowsObj[i]);
            }
        }
        $scope.day.table.rows = rows;
    });
