<div ng-controller="IndexCtrl" class="container">
    <span style="float: right;">
        {{user.first_name+' '+user.last_name}} <a href="" ng-click="logout()" >logout</a>
    </span>
    <div ng-controller="CustomerViewController" >
        <h2 style="color: blue">Welcome to Admin panel</h2>
        <h3><a href="#/admin">User Management</a>  |  Customer Management</h3>
        <table id="example" class="table table-striped table-hover" cellspacing="0" border="1" >
            <thead>
                <tr>
                    <th>Customer Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Company Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="customer in customers">
                    <td>{{customer.customer_id}}</td>
                    <td>{{customer.first_name}}</td>
                    <td>{{customer.last_name}}</td>
                    <td>{{customer.dob}}</td>
                    <td>{{customer.gender}}</td>
                    <td>{{customer.phone_no}}</td>
                    <td>{{customer.email}}</td>
                    <td>{{customer.company_name}}</td>             
                    <td><a href="#/edit-customer/{{customer.customer_id}}" class="btn btn-info">Edit</a>  | <a href="#/delete-customer/{{customer.customer_id}}" class="btn btn-danger ">Delete</a> </td>              
                </tr>
                
            </tbody>
        </table>
    </div>
</div>