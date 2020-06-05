       
<div class="col-lg-12" style="padding-left:20px;display:nne" ng-init="get_users(token)">
<h4>All Users</h4>  
<table class="table table-condensed table-striped">
<thead style="font-weight:bold">
<td>#</td>
<td></td>
<td>Full Name</td>
<td>Email</td>
<td>Institution</td>
<td>Educational Role</td>
<td>Status</td>
</thead>
<tr dir-paginate="user in all_users | filter:q | filter: userSearch |  itemsPerPage: pageSize" current-page="currentPage" ng-cloak>
<td>{{$index +1}}</td>
<td><img src="{{dirlocation}}{{user.image}}" style="width:40px;height:40px;border-radius:20px;"></td>
<td>{{user.first_name}}  {{user.last_name}}</td>
<td>{{user.email}}<br/><span style="font-size:11px">{{user.phone}}</span></td>
<td>{{user.institution}}<br/><span style="font-size:11px" ng-show="user.faculty!=''">{{user.faculty}}/{{user.department}}</span></td>
<td>{{user.educational_role}}</td>
<td><button ng-show="user.activated=='0'" ng-click="activate_or_deactivate_user('1',user,token,$index)" class="btn btn-default btn-xs"><img src="{{dirlocation}}public/images/spinner.gif" style="display:none" class="loader_{{user.id}}" width="20px">  Activate</btn> <button ng-show="user.activated=='1'" ng-click="activate_or_deactivate_user('0',user,token,$index)" class="btn btn-success btn-xs"> <img src="{{dirlocation}}public/images/spinner.gif" style="display:none" class="loader_{{user.id}}" width="20px"> Deactivate</btn></td>
</tr>
</table>     
</div>
        <!-- /.col -->