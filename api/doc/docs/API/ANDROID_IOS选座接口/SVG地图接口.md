---
---
### 安卓、IOS原生实现SVG地图接口参数说明
---
```
提交方式 : POST
URL :    /mobile/getCart
例 :    http://app.mydeershow.com/mobile/map?EventId=16&UserId=3f34&AppId=FEQWED&m=pc
```
|  参数英文名称 |  参数中文名称 | 是否必须    | 类型  | 参数说明 |
| ------------------ | ------------------- | ------------------- | ------------------ |----------------|
|AppId  | 商户号 |  否  |  int |AppId=2|
|EventId  | 场次编号 |  是  |  int |EventId=16|
|UserId  | 消费者编号 |  是  |  int |UserId=15|
|m  | 终端类型  |  是  |  string |m=pc、ios、android、wechat、h5|

#### 返回数据
**正确** 

```
{
    "code": "200",
    "startdate": 1351234123,
    "ismenu": 1,
    "panorama":"[{"id":"10","map_id":"5","section_id":"2","price_id":null,"seat_id":null,"mini":"panorama_1521529900.jpg","front":"panorama_1521529899.jpg","back":"panorama_1521529897.jpg","left":"panorama_1521529896.jpg","right":"panorama_1521529894.jpg","top":"panorama_1521529892.jpg","bottom":"panorama_1521529891.jpg"},{"id":"9","map_id":"5","section_id":"1","price_id":null,"seat_id":null,"mini":"panorama_1521527419.jpg","front":"panorama_1521527425.jpg","back":"panorama_1521527428.jpg","left":"panorama_1521527433.jpg","right":"panorama_1521527437.jpg","top":"panorama_1521527443.jpg","bottom":"panorama_1521527448.jpg"},{"id":"11","map_id":"5","section_id":"3","price_id":null,"seat_id":null,"mini":"panorama_1521529964.jpg","front":"panorama_1521529962.jpg","back":"panorama_1521529961.jpg","left":"panorama_1521529959.jpg","right":"panorama_1521529958.jpg","top":"panorama_1521529956.jpg","bottom":"panorama_1521529955.jpg"},{"id":"12","map_id":"5","section_id":"4","price_id":null,"seat_id":null,"mini":"panorama_1521530000.jpg","front":"panorama_1521530001.jpg","back":"panorama_1521530006.jpg","left":"panorama_1521530011.jpg","right":"panorama_1521530017.jpg","top":"panorama_1521530021.jpg","bottom":"panorama_1521530025.jpg"},{"id":"13","map_id":"5","section_id":"5","price_id":null,"seat_id":null,"mini":"panorama_1521530163.jpg","front":"panorama_1521530168.jpg","back":"panorama_1521530173.jpg","left":"panorama_1521530178.jpg","right":"panorama_1521530183.jpg","top":"panorama_1521530187.jpg","bottom":"panorama_1521530192.jpg"},{"id":"14","map_id":"5","section_id":"6","price_id":null,"seat_id":null,"mini":"panorama_1521531145.jpg","front":"panorama_1521531153.jpg","back":"panorama_1521531160.jpg","left":"panorama_1521531168.jpg","right":"panorama_1521531172.jpg","top":"panorama_1521531179.jpg","bottom":"panorama_1521531184.jpg"}]",
    "mapInfo": {
        "id": ｛"seats_no":"101区5排10号","unit_price":"880"｝,
        "show_id":｛"seats_no":"101区5排11号","unit_price":"880"｝,
        "map_name":｛"seats_no":"101区5排11号","unit_price":"880"｝,
        "background_url":"http:\/\/ticket.mydeershow.com\/uploads\/map\/mapBackground_1521507895.png",
        "mini_url":"http:\/\/ticket.mydeershow.com\/uploads\/map\/mapMini_1521083051.png",
        "area":"<path id=\"area_205\" area=\"205\" class=\"cls-7\" d=\"M391,714l-17,6L297,837l-9-7-7,9s76.508,66.661,204,75l15-29,5-137S451.643,746.746,391,714Z\"\/>\r\n  <path id=\"area_203\" area=\"203\" class=\"cls-7\" d=\"M529,747l-9,16,3,124,26,29s119.458-4.5,207-67l-5-10-15,8L650,717S609.655,750.638,529,747Z\"\/>\r\n  <path id=\"area_201\" area=\"201\" class=\"cls-7\" d=\"M773,585s-26.935,55.094-54,81l4,21,83,109-12,11,9,11s77.811-60.806,118-155l-24-25Z\"\/>\r\n  <path id=\"area_200\" area=\"200\" class=\"cls-7\" d=\"M780,403s25.061,84.149-3,165l129,46,36-8s43.944-130.976-3-256H908L804,387l-2-6-14,5,4,11Z\"\/>\r\n  <path id=\"area_202\" area=\"202\" class=\"cls-7\" d=\"M805,145l-12,13,13,10L722,283l7,5-11,13s33.643,29.486,52,78l131-52,21-27S889.293,218.981,805,145Z\"\/>\r\n  <path id=\"area_204\" area=\"204\" class=\"cls-7\" d=\"M549,47L523,77l-3,123,10,16s61.511-9.371,119,28l87-129,14,9,6-11S676.35,53.67,549,47Z\"\/>\r\n  <path id=\"area_206\" area=\"206\" class=\"cls-7\" d=\"M486,49s-112.173,2.525-206,75l8,9,9-7,77,117,17,6s56.235-34.092,114-33L500,77Z\"\/>\r\n  <path id=\"area_104\" area=\"104\" class=\"cls-7\" d=\"M391,271l26,34,7-5,10,47,25,30s48.29-42.322,130-5l60-109S514.105,187.316,391,271Z\"\/>\r\n  <path id=\"area_102\" area=\"102\" class=\"cls-7\" d=\"M682,285l-82,98s43.238,26.45,50,94l127-5S774.783,349.885,682,285Z\"\/>\r\n  <path id=\"area_101\" area=\"101\" class=\"cls-7\" d=\"M651,488s2.48,54.5-45,91l77,98s83.856-57.938,94-181Z\"\/>\r\n  <path id=\"area_103\" area=\"103\" class=\"cls-7\" d=\"M460,586l-25,30-10,49-7-6-26,35s118.856,82.437,257,5L590,592S512.153,626.629,460,586Z\"\/>\r\n  <path id=\"area_200\" area=\"200\" class=\"cls-7\" d=\"M834,463v41h37V462Z\"\/>",
        "price":"  <path display=\"none\" class=\"area_205_price_580 cls-1\" area=205 price=580 d=\"M410,726L392,836s34.371,17.9,108,23l3-110S478.4,754.325,410,726Z\"><\/path>\r\n  <path display=\"none\" class=\"area_205_price_280 cls-2\" area=205 price=280 d=\"M411,727a158.333,158.333,0,0,1-21-11l-14,5L298,839l-10-7-5,7s77.213,63.01,201,73l14-28,2-26s-49.283,1.509-107-22Z\"><\/path>\r\n  <path display=\"none\" class=\"area_203_price_280 cls-2\" area=203 price=280 d=\"M627,733l12,110s-45.514,15.513-115,18l1,25,25,28s111.7-3.215,203-65l-3-7-15,7L649,720S636.447,729.151,627,733Z\"><\/path>\r\n  <path display=\"none\" class=\"area_203_price_580 cls-1\" area=203 price=580 d=\"M530,749l-9,15,3,97s62.12,1.362,116-18L627,733S585.9,753.046,530,749Z\"><\/path>\r\n  <path display=\"none\" class=\"area_201_price_880 cls-3\" area=201 price=880 d=\"M920,664l-24-25L774,588s-26.755,53.913-53,78l3,20,84,110-12,11,7,9S876.94,759.205,920,664Z\"><\/path>\r\n  <path display=\"none\" class=\"area_200_price_1080 cls-4\" area=200 price=1080 d=\"M857,369l-54,20-3-6-10,4,4,11-12,5s24.918,87.447-3,165l77,27s19.459-53.861,17-89H832V460l42-1S870.976,408.361,857,369Z\"><\/path>\r\n  <path display=\"none\" class=\"area_200_price_880 cls-3\" area=200 price=880 d=\"M857,370l51-18,30-1s45.347,108.934,2,254l-34,7-51-18S894.882,505.74,857,370Z\"><\/path>\r\n  <path display=\"none\" class=\"area_202_price_880 cls-3\" area=202 price=880 d=\"M805,147l-9,10,12,11L724,282l7,6-11,13s31.422,28.518,51,76l129-51,21-26S891.119,225.226,805,147Z\"><\/path>\r\n  <path display=\"none\" class=\"area_204_price_280 cls-2\" area=204 price=280 d=\"M627,230l12-110s-45.514-15.513-115-18l1-25,25-28s111.7,3.215,203,65l-3,7-15-7L649,243S636.447,233.849,627,230Z\"><\/path>\r\n  <path display=\"none\" class=\"area_204_price_580 cls-1\" area=204 price=580 d=\"M530,214l-9-15,3-97s62.12-1.362,116,18L627,230S585.9,209.954,530,214Z\"><\/path>\r\n  <path display=\"none\" class=\"area_206_price_580 cls-1\" area=206 price=580 d=\"M410,237L392,127s34.371-17.9,108-23l3,110S478.4,208.675,410,237Z\"><\/path>\r\n  <path display=\"none\" class=\"area_206_price_280 cls-2\" area=206 price=280 d=\"M411,236a158.333,158.333,0,0,0-21,11l-14-5L298,124l-10,7-5-7s77.213-63.01,201-73l14,28,2,26s-49.283-1.509-107,22Z\"><\/path>\r\n  <path display=\"none\" class=\"area_101_price_1080 cls-4\" area=101 price=1080 d=\"M653,491s2.868,53.731-45,90l17,20s47.569-29,57-109Z\"><\/path>\r\n  <path display=\"none\" class=\"area_101_price_1080 cls-4\" area=101 price=1080 d=\"M718,494s1.846,79.159-69,138l35,43s80.256-63.942,90-178Z\"><\/path>\r\n  <path display=\"none\" class=\"area_101_price_1980 cls-5\" area=101 price=1980 d=\"M681,492s-3.356,71.7-57,109l25,32s66.7-50.587,70-139Z\"><\/path>\r\n  <path display=\"none\" class=\"area_102_price_1080 cls-4\" area=102 price=1080 d=\"M623,361l-20,22s43.4,28.821,49,92h30S681.11,402.568,623,361Z\"><\/path>\r\n  <path display=\"none\" class=\"area_102_price_1080 cls-4\" area=102 price=1080 d=\"M682,288l-35,42s70.308,50.6,73,143l55-4S771,354.215,682,288Z\"><\/path>\r\n  <path display=\"none\" class=\"area_102_price_1980 cls-5\" area=102 price=1980 d=\"M622,360l25-31s71.648,52.788,73,144l-39,2S682.462,403.06,622,360Z\"><\/path>\r\n  <path display=\"none\" class=\"area_103_price_880 cls-3\" area=103 price=880 d=\"M614,639l33,60s-120.538,73.05-253-6l24-32,8,6,7-35S510.154,692.406,614,639Z\"><\/path>\r\n  <path display=\"none\" class=\"area_103_price_1080 cls-4\" area=103 price=1080 d=\"M589,594l26,45s-88.2,54.67-182-6l3-15,24-29S509.724,629.191,589,594Z\"><\/path>\r\n  <path display=\"none\" class=\"area_104_price_880 cls-3\" area=104 price=880 d=\"M613,325l33-60s-120.538-73.05-253,6l24,32,8-6,7,35S509.154,271.594,613,325Z\"><\/path>\r\n  <path display=\"none\" class=\"area_104_price_1080 cls-4\" area=104 price=1080 d=\"M588,370l26-45s-88.2-54.67-182,6l3,15,24,29S508.724,334.809,588,370Z\"><\/path>",
        "seatsInfo":[{"id":"1","map_id":"5","section_id":"1","price_id":"1","map_name":"","section_name":"101","price_name":"","unit_price":"1080","seat_no":"s1_1_1","row":"1","column":"1","cy":"581.34522","cx":"618.00268","status":"1"},{"id":"2","map_id":"5","section_id":"1","price_id":"1","map_name":"","section_name":"101","price_name":"","unit_price":"1080","seat_no":"s2_1_2","row":"1","column":"2","cy":"576.18384","cx":"623.87597","status":"1"},{"id":"3","map_id":"5","section_id":"1","price_id":"1","map_name":"","section_name":"101","price_name":"","unit_price":"1080","seat_no":"s3_1_3","row":"1","column":"3","cy":"570.48853","cx":"629.03735","status":"1"}]
    }
    "eventInfo": {
        "id": ,
        "venue_id":,
        "startdate":123534234
    }
        
}
```

######  出参说明

|  参数英文名称 |  参数中文名称| 数据类型  |
| ------------  | ------------- | ------------- |
| 无返回参数 |无返回参数  | 无返回参数   |
---
---