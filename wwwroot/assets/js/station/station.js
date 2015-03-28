var setPosition = function(guid)
{
    var marker = user_list['gid_'+guid].marker;
    map.centerAndZoom(marker.getPosition(),5);
};

var CustomControl = function (){
  // 默认停靠位置和偏移量
  this.defaultAnchor = BMAP_ANCHOR_TOP_LEFT;
  this.defaultOffset = new BMap.Size(0, 0);
};

CustomControl.prototype = new BMap.Control();

CustomControl.prototype.initialize = function(map){
    //var div = '<input type="checkbox" name="show_markers" checked data-on-text="On" data-off-text="Off" />';
    // 创建一个DOM元素
    var div = document.createElement("input");
    // 设置样式
    div.type = "checkbox";
    div.name = "show_markers";
    div.checked = "true";
    // 添加DOM元素到地图中
    map.getContainer().appendChild(div);
    return div;
};

var initCustomControl = function()
{
    $('input[name="show_markers"]').data('on-text','显示');
    $('input[name="show_markers"]').data('off-text','隐藏');
    $('input[name="show_markers"]').data('size','small');
    
    $('input[name="show_markers"]').bootstrapSwitch();
    $('input[name="show_markers"]').on('switchChange.bootstrapSwitch', function(event, state) {
        if(state == true )
        {
            $.each( user_list, function(i, marker){
                marker.marker.show();
            });                    
        }
        else
        {
            $.each( user_list, function(i, marker){
                marker.marker.hide();
            });                  
        }
    });
    
};

var zoomChange = function(e,c_lv)
{
    if (e.zoomLevel >= c_lv)
    {
        $.each( user_list, function(i, marker){
            marker.marker.getLabel().show();
        });
    }
    else if (e.zoomLevel < c_lv)
    {
        $.each( user_list, function(i, marker){
            marker.marker.getLabel().hide();
        });
    }
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
//    var icon = new BMap.Icon('/assets/img/marker.png',{width:12,height:14});  // 创建文本标注对象
//    icon.setAnchor({width:12,height:25});
    var marker = new BMap.Marker(point,{title:'点击查看详细信息'});  // 创建标注
    marker.setLabel(label);
//    marker.setIcon(icon);
    map.addOverlay(marker);              // 将标注添加到地图中
    marker.addEventListener("click", function(e) {
        markerClick(e.target,userid);
    });
    
    marker.addEventListener("mouseover", function(e) {
        if(e.target.getMap().zoomLevel<=3)
        {
            label = e.target.getLabel();
            label.setOffset(new BMap.Size(12,-22));
            label.show();
        }
    });
    marker.addEventListener("mouseout", function(e) {
        if(e.target.getMap().zoomLevel<=3)
        {
            label = e.target.getLabel();
            label.setOffset(new BMap.Size(0,0));
            label.hide();
        }
    });
    
    eval('user_list.gid_'+marker.guid+'={"userid":userid,"marker":marker}');
    $('#station_list').append('<li id="st_li_'+marker.guid+'"><a href="javascript:deleteStation(\''+marker.guid+'\');">X</a> &nbsp;<a href="javascript:setPosition(\''+marker.guid+'\');">'+username+'</li>');
    return marker.guid;
}

var markerClick = function(marker,userid)
{
    var guid = marker.guid;
    var thisMarker = marker;
    thisMarker.setTop(true);
    $.ajax({
       type: "POST",
       url: "/user/getUserinfo",
       data: {'id':userid},
       success: function(data){
           var infoWindow = new BMap.InfoWindow(data);  // 创建信息窗口对象
           thisMarker.openInfoWindow(infoWindow);                
       }
    });
};

var selectedUser = function(userid)
{
    $.each(user_list, function(i, n){
        if(userid == n.userid)
        {
            label = n.marker.getLabel();
            label.setStyle({fontWeight:'bold'});
            markerClick(n.marker,userid);
            return true;
            //selectedAnimation(label,1);
        }
    });
};

var selectedAnimation = function(label,st)
{
    if(st == 0)
    {
        label.setStyle({color:'#F00',backgroundColor:'#FFF'});
        st = 1;
    }
    else
    {
        label.setStyle({color:'#FFF',backgroundColor:'#F00'});   
        st = 0;  
    }
    setTimeout(function(){selectedAnimation(label,st);},500);
};

var initLocation = function(mapid,select_id)
{
    var location_select = $('#locationlist');
    location_select.html('');
    var tmp_html = '<option value="0"></option>';    
    $.each(location_list, function(i, n){
        if(n.map_id == mapid)
        {
            if(n.id == select_id)
                tmp_html = tmp_html+'<option value="'+n.id+'" selected="selected">'+n.name+'</option>';
            else
                tmp_html = tmp_html+'<option value="'+n.id+'">'+n.name+'</option>';                
        }
    });
    location_select.html(tmp_html);
};


