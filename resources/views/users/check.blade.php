<div class="row justify-content-center p-2">
    <div style="width:330px">
        <div class="card text-center border-secondary">
            <div class="card-header bg-info text-white">
                Пожалуйста введите маха-секретное кодовое слово
            </div>
            <form action="{{ url('./') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <input type="password" class="form-control" id="yep" placeholder="код" maxlength="16" name="psrd" required>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mb-2">
                        <input class="btn btn-outline-success" type="submit" value="ВВОД" required>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>