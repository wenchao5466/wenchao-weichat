$(function() {
    $("#input-name").autocomplete({
        source: function(request, response) {
          response($.ui.autocomplete.filter(
            search_list, extractLast(request.term)));
        },
        focus: function(event, ui) {
            $("#input-name").val(ui.item.name);
            $('#input-name-term-id').val(ui.item.id);
            return false;
        },
        select: function(event, ui) {
            $("#input-name").val(ui.item.name);
            $('#input-name-term-id').val(ui.item.id);
            return false;
        }
    })
    .data("ui-autocomplete")._renderItem = function(ul, item) {
        var term = this.element.val(),
        name = item.name.replace(term, "<b>$&</b>");
        email = item.email.replace(term, "<b>$&</b>");
        phone_num = item.phone_num.replace(term, "<b>$&</b>");
        return $("<li>").append('<a href="###"><div class="first-line"><div class="pull-right text-node">' + email + '</div><span class="name text-node">' + name + '</span></div><div class="second-line"><div class="pull-right text-node">' + phone_num + '</div><span class="text-node">' + item.position + '</span></div></a>').appendTo(ul);
    };
    $('#add_btn').click(function(){
        var username = $("#input-name").val();
        var userid = $('#input-name-term-id').val();
        addStation(userid,username);
    });
    $("#save_btn").click(saveStation);
    
    function split(val) {
      return val.split(/,\s*/);
    }
    function extractLast(term) {
      return split(term).pop();
    }
});

var saveStation = function()
{
    var overlays = map.getOverlays();
    if($.isEmptyObject(user_list))
    {
        alert('工位列表为空');
        return false;
    }
    $('#save_btn').attr('disabled',true);
    $('#add_btn').attr('disabled',true);
    $('#save_btn').val('保存中');
    var list = new Array();
    $.each(user_list,function(i, n){
        position = n.marker.getPosition();
        label = n.marker.getLabel();
        obj ={'userid':n.userid,'username':label.content,'location_id':MAP_ID,'lng':position.lng,'lat':position.lat};
        list.push(obj);
    });
    var submitData = {'map_id':MAP_ID,'list':list};
    console.log(submitData);
    $.ajax({
        type: "POST",
        url: "/Station/save",
        dataType: 'json',
        data: submitData,
        success: function(data){
            $('#add_btn').attr('disabled',false);
            $('#save_btn').attr('disabled',false);
            $('#save_btn').val('保存');
            if(data.status == '0')
            {
                alert('保存成功');                
            }
        }
    });
};

var setPosition = function(guid)
{
    var marker = user_list['gid_'+guid].marker;
    map.panTo(marker.getPosition(),5);
};

function addStation(userid,username,lng,lat,notCheck)
{
    if(!userid)
    {
        alert('请先选择要添加的用户');
        return false;        
    }
    if(notCheck !== true)
    {
        var isCheck =false;
        $.each(user_list,function(i, n){            
            if(n.userid == userid)
            {
                isCheck = true;
                alert('该用户已存在');
                return false;
            }
        });
        if(isCheck == true)
        {
            return false;
        }
    }
    if(lng && lat)
    {
        var point = new BMap.Point(lng,lat);
    }
    else
    {
        var point = new BMap.Point(map.getCenter().lng, map.getCenter().lat);
    }
    var label_style = {
        color: "red",
        fontSize: "18px",
        height: "24px",
        lineHeight: "18px",
        fontFamily: "微软雅黑"
    };

    var label = new BMap.Label(username);  // 创建文本标注对象
    label.setStyle(label_style);
    label.enableMassClear();

    var marker = new BMap.Marker(point);  // 创建标注
    marker.setLabel(label);
    map.addOverlay(marker);              // 将标注添加到地图中
    marker.enableDragging();    //可拖拽
    eval('user_list.gid_'+marker.guid+'={"userid":userid,"marker":marker}');
    $('#station_list').append('<li id="st_li_'+marker.guid+'"><a href="javascript:deleteStation(\''+marker.guid+'\');">X</a> &nbsp;<a href="javascript:setPosition(\''+marker.guid+'\');">'+username+'</li>');
    return marker.guid;
}

function deleteStation(guid)
{
    eval('bd_marker = user_list.gid_'+guid+'.marker');
    map.removeOverlay(bd_marker);
    eval('delete user_list.gid_'+guid);
    $('#st_li_'+guid).remove();
}