<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="操作栏">
    <div class="btn-group mb-2" role="group" aria-label="First group">
        <a type="button" class="btn btn-success">新增</a>
    </div>
    <div class="d-flex mb-2">
        <form>
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="请输入关键字" aria-label="请输入关键字" required>
            <div class="input-group-append">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">搜索</button>
                    <button type="button" class="btn btn-primary dropdown-toggle active" title="高级搜索" data-toggle="collapse" data-target="#advanced-search-toggle" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                </div>
            </div>
        </div>
        </form>

        <div class="btn-group pl-2" style="width: 100px" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">排序 </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="#">Dropdown link</a>
                <a class="dropdown-item" href="#">Dropdown link</a>
            </div>
        </div>
    </div>
</div>
<div class="row collapse" id="advanced-search-toggle">
111
</div>
<table class="table mt-1">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
    </tr>
    </tbody>
</table>
<nav aria-label="Page navigation example" class="float-right">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
</nav>