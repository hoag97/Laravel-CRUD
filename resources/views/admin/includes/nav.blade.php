<div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#facadeDB"><i class="fa fa-fw fa-arrows-v"></i>Facades DB<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="facadeDB" class="collapse">
                    <li>
                        <a href="{{ route('facadeDB.list-member') }}">List Member</a>
                    </li>
                    <li>
                        <a href="{{ route('facadeDB.add-member') }}">Add Member</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#QueryBuilder"><i class="fa fa-fw fa-arrows-v"></i>Query Builder<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="QueryBuilder" class="collapse">
                    <li>
                        <a href="{{ route('QueryBuilder.list-member') }}">List Member</a>
                    </li>
                    <li>
                        <a href="{{ route('QueryBuilder.add-member') }}">Add Member</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#ORM"><i class="fa fa-fw fa-arrows-v"></i>ORM<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="ORM" class="collapse">
                    <li>
                        <a href="{{ route('ORM.list-member') }}">List Member</a>
                    </li>
                    <li>
                        <a href="{{ route('ORM.add-member') }}">Add Member</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>