<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Affiliates</title>
</head>
<body>
<main>
    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Affiliates</span>
            </a>
        </header>
        <div class="p-5 mb-4 bg-light rounded-3">
        <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>

            </div>
            @endif
        </div>
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Upload Affiliates list</h1>
                <form action="{{ route('get.nearby.affiliates') }}" method="POST" class="my-4" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" accept=".txt" class="form-control" name="affiliates">
                        <input type="submit" value="Upload" class="form-control btn btn-info">
                    </div>
                </form>
            </div>
            @if(session()->has('result'))
            <div class="card">
                <div class="card-header">
                    <h3>
                        List of affiliates within 100 KM's  
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Affiliates ID</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach(session()->get('result') as $affiliates)
                            <tr>
                                <td>{{$affiliates['name']}}</td>
                                <td>{{$affiliates['affiliate_id']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
</body>
</html>