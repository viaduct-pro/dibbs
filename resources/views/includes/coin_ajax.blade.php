<table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                @foreach($coin[0] as $key=>$value)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$value}}</td>
                    </tr>
                @endforeach
                </tbody>
</table>