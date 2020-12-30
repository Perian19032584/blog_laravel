<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav-link active" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#maindata">Основные данные</a></li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" id="title" class="form-control" minlength="3" required value="{{ $item->title }}">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ $item->slug }}">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Родитель</label>
                            <select name="parent_id" id="parent_id" class="form-control" placeholder="Выберите категорию" required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{$categoryOption->id}}" @if($categoryOption->id == $categoryOption->parent_id) selected @endif>{{$categoryOption->id}}. {{$categoryOption->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $item->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
