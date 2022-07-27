@extends('counters.layout')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <h2 class="text-center">قراءة العدادات - بلدية وادي غزة</h2>
            </div>
            <br>
        </div>
    </div>

    <div class="form-group">
        <form action="{{ route('counters.index') }}" method="GET" class="row">
            <div class="col-11 col-lg-7 offset-lg-2">
                <input name="search" value="{{ app('request')->get('search') }}" class="form-control" type="search"
                    placeholder="ابحث من خلال رقم العداد أو رقم الاشتراك أو رقم الموقع أو اسم المشترك أو عنوانه أو أي قراءة له ">
            </div>
            <div class="col-1 col-lg-1 mt-2">
                <button type="submit" class="btn btn-success">
                    ابحث <i class="fas fa-search fa-xl"></i> 
                </button>
            </div>
        </form>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>رقم </th>
            <th class="hide-on-small">رقم الموقع</th>
            <th>رقم الاشتراك</th>
            <th>المشترك</th>
            <th>رقم العداد</th>
            <th class="hide-on-small">القراءة السابقة</th>
            <th class="hide-on-small">القراءة الحالية</th>
            <th class="hide-on-small"> الاستهلاك بالكوب </th>
            <th class="hide-on-small">استهلاك</th>
            <th>إدارة</th>
        </tr>
        @foreach ($counters as $counter)
            <tr>
                <td>{{ $counter->number }}</td>
                <td class="hide-on-small">{{ $counter->position_number }}</td>
                <td>{{ $counter->subscription_number }}</td>
                <td>{{ $counter->subscriber }}</td>
                <td>{{ $counter->counter_number }}</td>
                <td class="hide-on-small">{{ $counter->previous_read }}</td>
                <td class="hide-on-small">{{ $counter->current_read }}</td>
                <td class="hide-on-small">{{ $counter->cups_consumption }}</td>
                <td class="hide-on-small">{{ $counter->shekels_consumption }} شيكل</td>
                <td>
                    <form action="{{ route('counters.destroy', $counter->id) }}" method="POST">
                        <a class="btn btn-info mt-2" href="{{ route('counters.show', $counter->id) }}"><i
                                class="fas fa-list"></i></a>
                        <a class="btn btn-primary mt-2" href="{{ route('counters.edit', $counter->id) }}"><i
                                class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mt-2 btn btn-danger"><i class="fas fa-trash fa-lg"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $counters->links('pagination::bootstrap-4') }}
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a class="btn btn-success" href="{{ route('counters.create') }}"> إضافة منشأة جديدة <i class="fas fa-plus"></i>
        </a>
        <a class="btn btn-success" href="{{ route('counters.refresh') }}"> تصفير العدادات <i class="fas fa-undo"></i> </a>
    </div>
    <br>
@endsection
