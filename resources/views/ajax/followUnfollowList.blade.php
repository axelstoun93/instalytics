<div class="col-sm-12 col-md-6">
        <div class="card-body card-dashboard">
            <table class="table table-striped follow-table">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Дата</th>
                        <th>Аккаунт</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($follow) and count($follow) >= 1)
                    @foreach($follow as $k => $v)
                        <tr class="statistic-green-follow">
                            <td>{{$k+1}}</td>
                            <td>{{$v->date_rus}}</td>
                            <td><a href="https://instagram.com/{{$v->login}}" target="_blank"> <i class="fa fa-instagram" aria-hidden="true"></i> https://instagram.com/{{$v->login}}</a></td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>№</th>
                        <th>Дата</th>
                        <th>Аккаунт</th>
                    </tr>
                    </tfoot>
            </table>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="card-body card-dashboard">

                <table class="table unfollow-table">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Дата</th>
                        <th>Аккаунт</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($unfollow) and count($unfollow) >= 1)
                    @foreach($unfollow as $k => $v)
                        <tr class="statistic-red-follow">
                            <td>{{$k+1}}</td>
                            <td>{{$v->date}}</td>
                            <td><a href="https://instagram.com/{{$v->login}}" target="_blank"> <i class="fa fa-instagram" aria-hidden="true"></i> https://instagram.com/{{$v->login}}</a></td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>№</th>
                        <th>Дата</th>
                        <th>Аккаунт</th>
                    </tr>
                    </tfoot>
                </table>
        </div>
    </div>
