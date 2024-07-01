@extends('layouts.bookManager')

@section('content')
<div class="text-center">
  @if(Session::has('bookManager'))
  @php
  $bookManager = Session::get('bookManager');
  @endphp
  <h1 class="mt-5">{{ $bookManager->name }}さん、こんにちは！</h1>
  @endif
  <h1 class="border-bottom">Books Statistics Graph</h1>
</div>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container mt-5 px-5 mb-5 pb-5">
  <h1 class="text-center refreshCust with-shadow  mb-5">書籍統計グラフ</h1>
  <!-- グラフを表示するための要素 -->
  <div>
    <canvas id="combinedChart" width="700" height="400"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // 3つのパラメータを組み合わせたグラフのコード
    const booksCount = <?php echo json_encode($booksCount); ?>;
    const authorsCount = <?php echo json_encode($authorsCount); ?>;
    const genresCount = <?php echo json_encode($genresCount); ?>;
    const combinedCtx = document.getElementById('combinedChart').getContext('2d');

    // 3つのパラメータを組み合わせたグラフ
    new Chart(combinedCtx, {
      type: 'bar',
      data: {
        labels: ['書籍', '著者', 'ジャンル'],
        datasets: [{
          label: 'カウント',
          data: [booksCount, authorsCount, genresCount],
          backgroundColor: [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
          ],
          borderWidth: 2
        }]
      },
      options: {
        scales: {
          x: {
            ticks: {
              font: {
                size: 20 // X軸ラベルのフォントサイズを大きくする
              },
              color: 'black' // X軸ラベルの色
            }
          },
          y: {
            beginAtZero: true,
            max: 60,
            ticks: {
              stepSize: 5,
              font: {
                size: 16
              },
              color: 'black'
            }
          }
        },
        plugins: {
          legend: {
            labels: {
              font: {
                size: 18
              }
            }
          }
        }
      }
    });


  });
</script>
@endsection