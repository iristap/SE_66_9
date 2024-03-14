@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left ">
                            <h2>Borrowing list</h2>
                        </div>

                        <div class="pull-right ">
                            <a class="btn btn-warning">considering</a><br><br>

                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Borrower</td>
                                        <td>Borrowing Date</td>
                                        <td>Due Date</td>
                                        <td>see the details</td>
                                        <td>see the details</td>
                                    </tr>
                                </thead>

                                <?php
                                foreach ($borrowing as $brItem) {
                                    $borrowDate = new DateTime($brItem->borrow_date);
                                    $dueDate = $borrowDate->add(new DateInterval('P14D'))->format('Y-m-d');

                                    echo "<tr>
                                    <td>{$brItem->borrowing_id}</td>
                                    <td>{$brItem->users_name}</td>
                                    <td>{$brItem->borrow_date}</td>
                                    <td>{$dueDate}</td>
                                    <td><a href='".route('borrowing.approved', ['id' => $brItem->borrowing_id])."' class='btn btn-success'>approved</a></td>
                                    <td><a href='".route('borrowing.not_approved', ['id' => $brItem->borrowing_id])."' class='btn btn-danger'>not approved</a></td>
                                </tr>";
                                }

                                echo '</tbody>';
                                echo '</table>';
                                ?>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
