<div class="shipmenttracking tracking section dhl_classes_comp_tracking_params"><script type="text/javascript" src="/etc/designs/dhl/docroot/tracking/js.js"></script>
<div class="tracking-results dhl_classes_comp_tracking_results">
<script type="text/ejs" id="tracking-results-express-template">

<%
    var isBlank = dhl.lib.util.isBlank;

    if (!isBlank(errors)) {
%>
    <div class="tracking-result-errors">
        <h2><%= messages.error.label %></h2>
        
        <ul class="error-message<%= errors.length <= 1 ? ' error-message-flat' : '' %>">
            <% can.each(errors, function(error, i) { %>
            <li>
                <% if (!isBlank(error.id)) { %>
                <strong><%= error.id %> (<%= error.label %>):</strong>
                <%= error.message %>
                <% } else { %>
                <strong><%= error.message %></strong>
                <% } %>
            </li>
            <% }); %>
        </ul>
    </div>

<%
    }

    if (!isBlank(results)) {
        if (duplicates.total > 0) {
%>
    <div class="tracking-duplicates<%= results.length == duplicates.total ? ' all-results' : '' %>">
        <p class="result-hint"><%= messages.duplicates.hint %></p>

        <h2><%= messages.duplicates.label %></h2>
        <%
            var result;
            can.each(duplicates.results, function(duplicate, j) {
        %>
        <form action="#" class="result-duplicates cl">
            <table summary="<%= messages.duplicates.summary %>">
                <colgroup>
                    <col class="column-id">
                    <col class="column-origin">
                    <col class="column-destination">
                </colgroup>
                <thead>
                    <tr>
                        <th><%= results[0].label %></th>
                        <th><%= results[0].origin.label %></th>
                        <th><%= results[0].destination.label %></th>
                    </tr>
                </thead>
                <tbody>
                <%
                    for (var k=0; k < duplicate.length; k++) {
                        result = results[duplicate[k]];
                %>
                    <tr data-result-index="<%= duplicate[k] %>">
                        <td class="waybill">
                            <input type="radio" name="tracking-duplicates-id" value="<%= result.id %>" />
                            <span><%= result.id %></span>
                        </td>
                        <td><%= !isBlank(result.origin) ? result.origin.value : '' %></td>
                        <td><%= !isBlank(result.destination) ? result.destination.value : ''%></td>
                    </tr>
                <% } %>
                </tbody>
            </table>
            <input type="submit" value="<%= messages.duplicates.button %>" />
        </form>
        <% }); %>
    </div>
    <% } %>

    <div class="tracking-result-header cl<%= results.length == duplicates.total ? ' hd' : '' %>">
        <h2><%= messages.label %></h2>
    
        <% if (results.length > 1) { %>
        <p class="result-details-toggle-all">
            <a class="arrow show" href="#"><%= messages.details.all.show %></a>
        </p>
        <% } %>
    </div>

    <%
        can.each(results, function(result, i) {
            var hasPieces = !isBlank(result.pieces, 'pIds') && result.pieces.pIds.length > 0,
                hasEdd = !isBlank(result.edd);
    %>
    <div class="tracking-result express<%= result.duplicate ? ' hd' : '' %>">

        <table class="result-summary<%= hasPieces ? ' result-has-pieces' : '' %><%= hasEdd ? ' result-has-edd' : '' %>" summary="<%= messages.details.summary %> <%= result.id %>">
            <colgroup>
                <col class="column-delivery-state">
                <col class="column-waybill">
                <col class="column-destination">
                <% if (hasEdd || hasPieces) { %>
                <col class="column-pieces">
                <% } %>
            </colgroup>
            <tbody>
                <tr>
                    <td class="delivery code<%= result.delivery.code %>" title="<%= result.delivery.status.toUpperCase() %>"></td>
                    <td class="waybill<%= isBlank(result.eventRemark) ? ' result-has-no-remarks' : '' %>">
                        <strong><%= result.label %>: <%= result.id %></strong>

                        <% if (!isBlank(result.signature)) { %>
                        <span>
                            <% if (!isBlank(result.signature.label)) { %>
                            <%= result.signature.label %>:
                            <% } %>
                            <%= result.signature.signatory %>
                        </span>
                            <% if (!isBlank(result.signature.link, 'url')) { %>
                        <span class="<%= result.signature.type == 'epod' ? 'result-signature-epod' : 'result-signature-proview' %>"><a class="arrow" target="_blank" href="<%= result.signature.link.url %>"><%= result.signature.link.label %></a></span>
                            <% } %>
                        <% } %>
                    </td>
                    <td>
                        <% if (!isBlank(result.signature)) { %>
                        <span><%= result.signature.description %></span>
                        <% } %>

                        <% if (!isBlank(result.origin)) { %>
                        <span><%= result.origin.label %>:</span>
                            <% if (!isBlank(result.origin.url)) { %>
                        <a class="arrow" target="_blank" href="<%= result.origin.url %>"><%= result.origin.value %></a>
                            <% } else { %>
                        <%= result.origin.value %>
                            <% } %>
                        <% } %>

                        <% if (isBlank(result.eventRemark) && !isBlank(result.destination)) { %>
                        <span><%= result.destination.label %>:</span>
                            <% if (!isBlank(result.destination.url)) { %>
                        <a class="arrow" target="_blank" href="<%= result.destination.url %>"><%= result.destination.value %></a>
                            <% } else { %>
                        <%= result.destination.value %>
                            <% } %>
                        <% } %>
                    </td>
                    <% if (hasEdd || hasPieces) { %>
                    <td>
                        <% if (hasEdd) { %>
                        <div class="result-edd" title="<%= result.edd.comments %>">
                            <% if (isBlank(result.edd.comments) && isBlank(result.edd.product) && isBlank(result.edd.date)) { %>
                            <span class="result-eddd-label-text"><%= result.edd.label %><%= !isBlank(result.edd.date) || !isBlank(result.edd.product) ? ':' : '' %></span>
                            <% } else { %>
                            <span class="result-eddd-label"><%= result.edd.label %><%= !isBlank(result.edd.date) || !isBlank(result.edd.product) ? ':' : '' %></span>
                            <% } %>
                            <% if (!isBlank(result.edd.date)) { %>
                            <span class="result-eddd-date-text"><%= result.edd.date %></span>
                            <% } %>
                            <% if (!isBlank(result.edd.product)) { %> 
                            <span class="result-eddd-product-text"><%= result.edd.product %></span>
                            <% } %>
                        </div>
                        <% } %>

                        <% if (hasPieces && result.pieces.showSummary) { %>
                        <div class="result-pieces">
                            <p>
                                <%= result.pieces.value %>
                                <%= result.pieces.label %>
                            </p>

                            <ul>
                            <% can.each(result.pieces.pIds, function(pid, i) { %>
                               <li><%= pid %></li>
                            <% }); %>
                            </ul>
                        </div>
                        <% } %>
                    </td>
                    <% } %>
                </tr>
                <% if (!isBlank(result.eventRemark)) { %>
                <tr class="result-event-remarks">
                    <td><strong></strong></td>
                    <td>
                        <span><%= messages.details.furtherdetail %>:</span>
                        <p><%= result.eventRemark %></p>
                    </td>
                    <td>
                        <% if (!isBlank(result.eventNextStep)) { %>
                        <span><%= messages.details.nextstep %>:</span>
                        <p><%= result.eventNextStep %></p>
                        <% } %>
                    </td>
                    <% if (hasEdd || hasPieces) { %>
                    <td></td>
                    <% } %>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <% if (!isBlank(result.destination)) { %>
                        <span><%= result.destination.label %>:</span>
                            <% if (!isBlank(result.destination.url)) { %>
                        <a class="arrow" target="_blank" href="<%= result.destination.url %>"><%= result.destination.value %></a>
                            <% } else { %>
                        <%= result.destination.value %>
                            <% } %>
                        <% } %>
                    </td>
                    <% if (hasEdd || hasPieces) { %>
                    <td></td>
                    <% } %>
                </tr>
                <% } %>
            </tbody>
        </table>

        <% if (!isBlank(result.checkpoints)) { %>
        <table class="result-checkpoints<%= results.length > 1 ? '' : ' show' %><%= hasPieces ? ' result-has-pieces' : '' %><%= hasEdd ? ' result-has-edd' : '' %>" summary="<%= messages.checkpoints.summary %>">
             <colgroup>
                <col class="column-counter">
                <col class="column-description">
                <col class="column-location">
                <col class="column-time">
                <% if (hasPieces) { %>
                <col class="column-piece">
                <% } %>
            </colgroup>
           <%
                var storedCheckpointDate;
                can.each(result.checkpoints, function(checkpoint, j) {
                    if (checkpoint.date !== storedCheckpointDate) {
                        storedCheckpointDate = checkpoint.date;
                        if (j !== 0) {
            %>
            </tbody>
                    <% } %>
            <thead>
                <tr>
                    <th colspan="2"><%= checkpoint.date %></th>
                    <th><%= result.checkpointLocationLabel %></th>
                    <th><%= result.checkpointTimeLabel %></th>
                    <% if (hasPieces) { %>
                    <th><%= result.pieces.label %></th>
                    <% } %>
                </tr>
            </thead>
            <tbody>
                <% } %>
                    <tr>
                        <td><%= checkpoint.counter %></td>
                        <td><%= checkpoint.description %></td>
                        <td><%= checkpoint.location %></td>
                        <td><%= checkpoint.time %></td>
                        <% if (hasPieces) { %>
                        <td class="result-pieces">
                            <% if (!isBlank(checkpoint.totalPieces)) { %>
                            <p>
                                <%= checkpoint.totalPieces %>
                                <%= result.pieces.label %>
                            </p>

                            <ul>
                            <% can.each(checkpoint.pIds, function(pid, i) { %>
                               <li><%= pid %></li>
                            <% }); %>
                            </ul>
                            <% } %>
                        </td>
                        <% } %>
                    </tr>
            <% }); %>
            </tbody>
        </table>
        <% } %>

        <% if (!isBlank(result.extraShipmentDetails)) { %>
        <table class="result-extra-shipment-details<%= results.length > 1 ? '' : ' show' %>" summary="<%= messages.extraShipmentDetails.summary %>">
             <colgroup>
                <col class="column-from">
                <col class="column-to">
                <col class="column-information">
            </colgroup>
            <thead>
                <tr>
                    <th colspan="3">
                        <%= messages.extraShipmentDetails.header.details %>
                        <% if (!isBlank(messages.extraShipmentDetails.help.url)) { %>
                        <a href="<%= messages.extraShipmentDetails.help.url %>"><%= messages.extraShipmentDetails.help.label %></a>
                        <% } %>
                    </th>
                </tr>
                <tr>
                    <th><%= messages.extraShipmentDetails.header.from %></th>
                    <th><%= messages.extraShipmentDetails.header.to %></th>
                    <th><%= messages.extraShipmentDetails.header.information %></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <% can.each(result.extraShipmentDetails.from, function(from) { %>
                        <span><%= from %></span> 
                        <% }); %>
                    </td>
                    <td>
                        <% can.each(result.extraShipmentDetails.to, function(to) { %>
                        <span><%= to %></span> 
                        <% }); %>
                    </td>
                    <td>
                        <%
                            if (!isBlank(result.extraShipmentDetails.information)) {
                                var information = result.extraShipmentDetails.information,
                                    order = [3,5,0,4,6,2,1]; // establish a fixed property order

                                for (var i=0; i < order.length; i++) {
                                    if (!isBlank(information[order[i]])) {
                        %>
                        <span>
                            <%= information[order[i]].label %>: <%= information[order[i]].value %>
                            <% if ((order[i] == 0) && !isBlank(result.extraShipmentDetails.noteOnWeight)) { %> 
                            <span class="note-on-weight" title="<%= result.extraShipmentDetails.noteOnWeight.value %>"><%= result.extraShipmentDetails.noteOnWeight.label %></span> 
                            <% } %>
                        </span> 
                        <%
                                    }
                                }
                            }
                        %>
                    </td>
                </tr>
            </tbody>
        </table>
        <% } %>

        <p class="result-details-toggle">
            <% if (results.length > 1) { %>
            <a class="arrow show" href="#"><%= messages.details.single.show %></a>
            <% } else { %>
            <a class="arrow" href="#"><%= messages.details.single.hide %></a>
            <% } %>
        </p>
    </div>
    <% }); %>
        
    <% if (!isBlank(signature, 'link')) { %>
    <p class="result-epods<%= results.length == duplicates.total ? ' hd' : '' %>">
        <a class="arrow" target="_blank" href="<%= signature.link.url %>"><%= signature.link.label %></a>
    </p>
    <% } %>
    
    <button class="results-print tracking-button<%= results.length == duplicates.total ? ' hd' : '' %>">
        <span><%= messages.print %></span>
    </button>
<% } %>
</script><script type="text/javascript" class="config">
    // <![CDATA[
    ( new Object({"name":"tracking-results","config":{"iframe":{"targetOrigin":"http://www.dhl.de"},"measurement":{"enabled":false},"text":{"loading":{"progress":"Tracking results are being retrieved... Please stand by."},"messages":{"checkpoints":{"summary":"DHL Express shipments checkpoints"},"details":{"all":{"hide":"隐藏全部","show":"显示全部"},"furtherdetail":"详细信息","nextstep":"下一步","single":{"hide":"隐藏详细信息","show":"显示详细信息"},"summary":"Your DHL Express shipment no."},"duplicates":{"button":"解决","hint":"在系统中存在具有相同识别号的多票快件。请在下方选择您的发件地和目的地。请放心这并不会影响您发送快件的转运时间。","label":"解决重复","summary":"DHL Express shipment duplicates"},"error":{"label":"跟踪错误。","noResults":"对不起！我们的跟踪服务暂时无法使用。"},"extraShipmentDetails":{"header":{"details":"Shipment Details...","from":"From","information":"Shipment Information","to":"To"},"help":{"label":"Help","url":""},"summary":"DHL Express extra shipments details"},"label":"查询结果汇总","print":"Print"},"webtrends":{"enabled":false},"multiple":{"tags":[],"url":"/zh/express/tracking"},"single":{"tags":[]}}}}) );
    // ]]>
    </script>
    

	 <div class="tracking-result-header cl">
		  <h2>查询结果汇总</h2>
	 
		  
	 </div>
	 
	 <div class="tracking-result express">
		  <table class="result-summary result-has-pieces" summary="Your DHL Express shipment no. 9159548134">
				<colgroup>
					 <col class="column-delivery-state">
					 <col class="column-waybill">
					 <col class="column-destination">
					 
					 <col class="column-pieces">
					 
				</colgroup>
				<tbody>
					 <tr>
						  <td class="delivery code101" title="DELIVERED"></td>
						  <td class="waybill result-has-no-remarks">
								<strong>运单: 9159548134</strong>
								
								<span>
									 
									 快件通过第三方派送无法得到签收结果 
								</span>
									 
								<span class="result-signature-epod"><a class="arrow" target="_blank" href="https://webpod.dhl.com/webPOD/DHLePODRequest?hwb=Tm1aW5UhJHHQjM5unj%2BBqQ%3D%3D&amp;pudate=Srz1O0TGDiuWYDkkkbDSRQ%3D%3D&amp;appuid=nTuonI%2FN%2FZkkheDaTE%2F%2Fcg%3D%3D&amp;language=zh&amp;country=CN">获取签收凭证</a></span>
									 
								
						  </td>
						  <td>
								
								<span>星期一, 三月 27, 2017  于 16:26</span>
								
								
								<span>发件地服务区域:</span>
									 
								<a class="arrow" target="_blank" href="http://www.cn.dhl.com/en/country_profile.html">SHANGHAI - SHANGHAI - CHINA, PEOPLES REPUBLIC</a>
									 
								
								
								<span>目的地服务区域:</span>
									 
								<a class="arrow" target="_blank" href="http://www.dhl.co.id/en/country_profile.html">BANDUNG - KABUPATEN CIREBON - INDONESIA</a>
									 
								
						  </td>
						  
						  <td>
								
								
								<div class="result-pieces">
									 <p>
										  1
										  件
									 </p>
									 <ul>
									 
										 <li>JD014600003993682543</li>
									 
									 </ul>
								</div>
								
						  </td>
						  
					 </tr>
					 
				</tbody>
		  </table>
		  
		  <table class="result-checkpoints show result-has-pieces" summary="DHL Express shipments checkpoints" style="display: table;">
				 <colgroup>
					 <col class="column-counter">
					 <col class="column-description">
					 <col class="column-location">
					 <col class="column-time">
					 
					 <col class="column-piece">
					 
				</colgroup>
			  
				<thead>
					 <tr>
						  <th colspan="2">星期一, 三月 27, 2017 </th>
						  <th>位置</th>
						  <th>时间</th>
						  
						  <th>件</th>
						  
					 </tr>
				</thead>
				<tbody>
					 
						  <tr>
								<td>11</td>
								<td>快件通过第三方派送无法得到签收结果</td>
								<td>BANDUNG - INDONESIA</td>
								<td>16:26</td>
								
								<td class="result-pieces">
									 
									 <p>
										  1
										  件
									 </p>
									 <ul>
									 
										 <li>JD014600003993682543</li>
									 
									 </ul>
									 
								</td>
								
						  </tr>
				
						  <tr>
								<td>10</td>
								<td>快件已经到达派送作业地点 BANDUNG - INDONESIA</td>
								<td>BANDUNG - INDONESIA</td>
								<td>14:26</td>
								
								<td class="result-pieces">
									 
									 <p>
										  1
										  件
									 </p>
									 <ul>
									 
										 <li>JD014600003993682543</li>
									 
									 </ul>
									 
								</td>
								
						  </tr>
				
						  <tr>
								<td>9</td>
								<td>离开转运地 JAKARTA - INDONESIA</td>
								<td>JAKARTA - INDONESIA</td>
								<td>10:59</td>
								
								<td class="result-pieces">
									 
									 <p>
										  1
										  件
									 </p>
									 <ul>
									 
										 <li>JD014600003993682543</li>
									 
									 </ul>
									 
								</td>
								
						  </tr>
				
						  <tr>
								<td>8</td>
								<td>正在（已经）安排下一站的转运 JAKARTA - INDONESIA</td>
								<td>JAKARTA - INDONESIA</td>
								<td>10:58</td>
								
								<td class="result-pieces">
									 
									 <p>
										  1
										  件
									 </p>
									 <ul>
									 
										 <li>JD014600003993682543</li>
									 
									 </ul>
									 
								</td>
								
						  </tr>
				
						  <tr>
								<td>7</td>
								<td>快件到达中转中心 JAKARTA - INDONESIA</td>
								<td>JAKARTA - INDONESIA</td>
								<td>09:35</td>
								
								<td class="result-pieces">
									 
									 <p>
										  1
										  件
									 </p>
									 <ul>
									 
										 <li>JD014600003993682543</li>
									 
									 </ul>
									 
								</td>
								
						  </tr>
				
				</tbody>
						  
				<thead>
					 <tr>
						  <th colspan="2">星期日, 三月 26, 2017 </th>
						  <th>位置</th>
						  <th>时间</th>
						  
						  <th>件</th>
						  
					 </tr>
				</thead>
				<tbody>
					 
						  <tr>
								<td>6</td>
								<td>离开转运地 EAST CHINA AREA - CHINA, PEOPLES REPUBLIC</td>
								<td>EAST CHINA AREA - CHINA, PEOPLES REPUBLIC</td>
								<td>08:17</td>
								
								<td class="result-pieces">
									 
									 <p>
										  1
										  件
									 </p>
									 <ul>
									 
										 <li>JD014600003993682543</li>
									 
									 </ul>
									 
								</td>
								
						  </tr>
				
						  <tr>
								<td>5</td>
								<td>正在（已经）安排下一站的转运 EAST CHINA AREA - CHINA, PEOPLES REPUBLIC</td>
								<td>EAST CHINA AREA - CHINA, PEOPLES REPUBLIC</td>
								<td>08:17</td>
								
								<td class="result-pieces">
									 
									 <p>
										  1
										  件
									 </p>
									 <ul>
									 
										 <li>JD014600003993682543</li>
									 
									 </ul>
									 
								</td>
								
						  </tr>
				
				</tbody>
						  
				<thead>
					 <tr>
						  <th colspan="2">星期六, 三月 25, 2017 </th>
						  <th>位置</th>
						  <th>时间</th>
						  
						  <th>件</th>
						  
					 </tr>
				</thead>
				<tbody>
					 
						  <tr>
								<td>4</td>
								<td>快件已完成清关手续并从海关放行 EAST CHINA AREA - CHINA, PEOPLES REPUBLIC</td>
								<td>EAST CHINA AREA - CHINA, PEOPLES REPUBLIC</td>
								<td>22:03</td>
								
								<td class="result-pieces">
									 
								</td>
								
						  </tr>
				
						  <tr>
								<td>3</td>
								<td>离开转运地 SHANGHAI - CHINA, PEOPLES REPUBLIC</td>
								<td>SHANGHAI - CHINA, PEOPLES REPUBLIC</td>
								<td>21:28</td>
								
								<td class="result-pieces">
									 
									 <p>
										  1
										  件
									 </p>
									 <ul>
									 
										 <li>JD014600003993682543</li>
									 
									 </ul>
									 
								</td>
								
						  </tr>
				
						  <tr>
								<td>2</td>
								<td>正在（已经）安排下一站的转运 SHANGHAI - CHINA, PEOPLES REPUBLIC</td>
								<td>SHANGHAI - CHINA, PEOPLES REPUBLIC</td>
								<td>20:47</td>
								
								<td class="result-pieces">
									 
									 <p>
										  1
										  件
									 </p>
									 <ul>
									 
										 <li>JD014600003993682543</li>
									 
									 </ul>
									 
								</td>
								
						  </tr>
				
						  <tr>
								<td>1</td>
								<td>快件已从发件人处提取</td>
								<td>SHANGHAI - CHINA, PEOPLES REPUBLIC</td>
								<td>19:43</td>
								
								<td class="result-pieces">
									 
								</td>
								
						  </tr>
				
				</tbody>
		  </table>
		  
		  
		  <p class="result-details-toggle">
				
				<a class="arrow" href="#">隐藏详细信息</a>
				
		  </p>
	 </div>
	 
		  
	 
	 
	 <button class="results-print tracking-button">
		  <span>Print</span>
	 </button>

</div><script type="text/javascript" src="/etc/designs/dhl/docroot/tracking/js/tracking-utils-shipment.js"></script>

<script type="text/javascript"> 
// <![CDATA[
    // variables
    var areNotValidAWBorPiece = "不是有效的运单号码或单件识别号码。";
    var combinationNotAllowed = "不允许组合。";
    var correctAWB = "请更正或移除这些运单号码。";
    var correctRemove = "请更正或移除无效的输入内容。";
    var duplicatevalue = "快件号码重复";
    var entries = "输入";
    var entry = "输入";
    var errorDuplicateNumber = "您输入相同的跟踪号码的次数已经超出系统限制。";
    var errorEmpty = "您在文本框中未输入任何内容。";
    var errorMixed = "不允许组合使用运单号与单件识别号。";
    var errorZero = "请输入一个有效的快件号码。";
    var finalPieceStr  = "";
    var invalidEntry = "无效的输入。";
    var invalidValues ="无效的快件号。";
    var isAwb = "是一个运单号码。";
    var isNotValidAWBorPiece = "不是一个有效的运单号码或单件识别号码。";
    var isPieceId = "是一个单件识别号码。";
    var lessthanTenNumber = "请输入10个或少于10个的数字。";
    var notAwb1 = "不是一个有效的运单号码。";
    var notPieceId1 = "或一个有效的单件识别号码。";
    var noValues = "请输入一个跟踪号码。";
    var onlyOne = "仅一个";
    var pleaseEnter = "请输入";
    var reasonForReject = "";
    var reasonForSuccess = "";
    var selectShipType = "请选择一个适当的快件类型。";
    var shipType = "没有选择快件类型。";
    var shipmentnumbersfield ="请输入您的跟踪号码";
    var toomanyInput = "输入了过多的跟踪号码。";
    var toomanyNumber = "数字过多。";
    // tracking engines
    var trackingEngines = [];
    
        trackingEngines.push( {
            brand: 'DHL',
            url: ''
        } );
    

    function enableWebtrendsTracking() {
    
    } 
// ]]>
</script>

<div class="dhl tracking-form tracking-shipment cl dhl_classes_comp_tracking_form"><p class="tracking-form-new-search"><a class="arrow" href="#">尝试一个新搜索。</a></p>
    <div class="wrap1 hd">
        <div class="wrap2">
            <div class="wrap3">
                <div class="wrap4">
                    <div class="wrap5">
                        <div class="wrap6">
                            <div class="wrap7">
                                <div class="wrap8">
                                    <form name="trackingIndex" id="trackingIndex" method="get" action="/zh/express/tracking.html">
                                        <fieldset>
                                            <legend>跟踪</legend>

                                            <noscript>
                                               &lt;p class="error"&gt;
                                                   &lt;strong&gt;执行跟踪查询需要使用Java Script。请启用浏览器设置中的Java Script。&lt;/strong&gt;
                                               &lt;/p&gt;
                                            </noscript>

                                            <div class="shipment_type">
                                                <label for="brand">选择快件类型</label>
                                                <select name="brand" id="brand" class="shipment">
                                                    <option title="快递服务" value="DHL">快递服务</option>
                                                    </select>
                                                
                                                <br>
                                            
                                                </div>

                                            <div class="tracking_no">
                                                <label for="AWB">跟踪号码</label>
                                                <div class="text_area">                                     
                                                    <textarea id="AWB" rows="3" cols="40" name="AWB">请输入您的跟踪号码</textarea>
                                                    <p>如果您要一次跟踪多达10个运单号码，请用逗号（，）或者回车键（Enter）分隔各个运单号码。</p>
                                                </div>
    
                                                </div>
                                            
                                            <button class="tracking-button">
                                                <span>跟踪</span>
                                            </button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearAll"> </div>

    <script type="text/javascript" class="config">
    // <![CDATA[
        ( new Object( {
            "name": "tracking-form",
            "config": {
                awbDefaultValue: '\u8BF7\u8F93\u5165\u60A8\u7684\u8DDF\u8E2A\u53F7\u7801',
                text: {
                    newSearch: '\u5C1D\u8BD5\u4E00\u4E2A\u65B0\u641C\u7D22\u3002'
                }
                
            }
        } ) );
// ]]>
</script>
</div>
<script type="text/javascript" class="config">
// <![CDATA[
( new Object({"name":"tracking","config":{"logEnabled":false,"params":{"countryCode":{"value":"cn"},"languageCode":{"value":"zh"}}}}) );
// ]]>
</script></div>