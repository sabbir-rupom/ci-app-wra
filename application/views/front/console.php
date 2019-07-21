<div class="row">
    <div class="col-12">
        <h2 class="mt-3">
            RESTful API List
        </h2>
        <hr class="mt-1">
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-3">
        <div class="accordion" id="listAPI">
            <div class="card">
                <div class="card-header" id="sectionOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#userAPI" aria-expanded="true" aria-controls="userAPI">
                            User Related
                        </button>
                    </h5>
                </div>

                <div id="userAPI" class="collapse show" aria-labelledby="sectionOne" data-parent="#listAPI">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#">User Sign Up</a></li>
                            <li class="list-group-item"><a href="#">User Login</a></li>
                            <li class="list-group-item"><a href="#">Get User Info</a></li>
                            <li class="list-group-item"><a href="#">Save User Info</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="sectionTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#itemAPI" aria-expanded="false" aria-controls="itemAPI">
                            Item Related
                        </button>
                    </h5>
                </div>
                <div id="itemAPI" class="collapse" aria-labelledby="sectionTwo" data-parent="#listAPI">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#">Get All Items</a></li>
                            <li class="list-group-item"><a href="#">User Item List</a></li>
                            <li class="list-group-item"><a href="#">Add User Item</a></li>
                            <li class="list-group-item"><a href="#">Update User Item</a></li>
                            <li class="list-group-item"><a href="#">Delete User Item</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-9">
        <form id="apiForm">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Method</label>
                <div class="col-sm-10">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="method" value="GET">GET
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="method" value="POST">POST
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="method" value="PUT">PUT
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="method" value="DELETE">DELETE
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Base URL</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="baseUrl" placeholder="http://api-url.com">
                    <small class="form-text text-muted">
                        check base url before submitting API request
                    </small>
                </div>
                <label class="col-sm-2 col-form-label text-right">API Path</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="apiPath" placeholder="/api-end-point">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Query Params</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="queryParams" placeholder="Get query parameters [ example: app_id=123&client_version=2 ... ]">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Token Secret</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="tokenSecret" placeholder="Enter Secret Key" value="0123456789">
                    <small class="form-text text-muted">
                        Secret key to determine valid client request from a device
                    </small>
                </div>
                <label class="col-sm-2 offset-sm-1 col-form-label text-right">User ID</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="userId" readonly value="N/A">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Auth Token</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="accessToken" placeholder="Encoded access token">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">JSON Body</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="requestBody" placeholder="Enter post requests in JSON"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="button" class="btn btn-primary" id="submit" disabled onclick="callApi()">Submit</button>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <!--<a data-toggle="tab" href="#home">Home</a>-->
                            <a class="nav-link active" data-toggle="tab" href="#jsonResponse">Response</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#serverHeaders">Header</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="jsonResponse" class="tab-pane fade active show">
                            <div class="row">
                                <div class="col">
                                    <pre id="jsonOutput"></pre>
                                </div>
                            </div>
                        </div>
                        <div id="serverHeaders" class="tab-pane fade">
                            <div class="row">
                                <div class="col">
                                    <div id="responseHeader">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form> 
    </div>
</div>
