
<?php include 'layout/app.php' ?>

<?php startblock('nav') ?>
   <div class="container">
    </div>
<?php endblock() ?>

<?php startblock('content') ?>
        <div class="row" v-if="login===true">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-heading">
                        <div class="card-header"><h1 class="font-weight-bold text-center">Simple Banking System</h1></div>
                    </div>
                    <div class="card-body">
                            <form action="login" @submit.prevent="tryLogin" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <label for="account_number">Numbers Only: </label>
                                        <input v-model="input_id"class="form-control" type="text" name="account_number" pattern="[0-9]*" inputmode="numeric" id="" placeholder="account number" maxlength="10"required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input v-model="input_pin"class="form-control" type="password" name="pin" id="" placeholder="pin" pattern="[0-9]*" maxlength="4"inputmode="numeric" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="btn btn-primary" type="submit" value="Login">
                                    </div>
                                    <div class="col">
                                        <input class="btn btn-primary float-right" type="button" @click="switchForm(1)"value="Signup">
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else-if="signup===true">
            <div class="col-lg-12">
                <div class="card">
                        <div class="card-heading">
                            <div class="card-header"><h1 class="font-weight-bold text-center">Simple Banking System</h1></div>
                        </div>
                        <div class="card-body">
                            <form action="signup" @submit.prevent="trySignUp" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <input v-model="input_username"class="form-control" type="text" name="username" id="" placeholder="username"required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input v-model="input_id"class="form-control" type="text" name="account_number" id="" placeholder="account number" maxlength="10"required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input v-model="input_pin"class="form-control" type="password" name="pin" id="" placeholder="pin" pattern="[0-9]*" maxlength="4"inputmode="numeric" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="btn btn-primary" type="submit" value="Signup">
                                    </div>
                                    <div class="col">
                                        <input class="btn btn-primary float-right" type="button" @click="switchForm(2)"value="Back To Login">
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-lg-12">
                 <div class="card"  v-if="cardwindow===1">
                     <div class="card-heading text-center"><h1><strong>Menu</strong></h1></div>
                     <div class="card-header"><h5> Welcome {{user[1]}}! select and click to proceed.</h5></div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col">
                                <div @click="switchToCard(2)"class="rows text-center align-center py-4 bg-info"><h3>View Balance</h3></div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col">
                                <div @click="switchToCard(3)"class="rows text-center align-center py-4 bg-success"><h3>Deposit</h3></div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col">
                                <div @click="switchToCard(4)"class="rows text-center align-center py-4 bg-primary"><h3>Withdraw</h3></div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col">
                                <div @click="tryLogout"class="rows text-center align-center py-4 bg-warning"><h3>Log out</h3></div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card"  v-else-if="cardwindow===2">
                     <div class="card-heading text-center"><h1><strong>Balance</strong></h1></div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col">
                                <div @click="switchToCard(2)"class="rows text-center align-center py-4 bg-info"><h3>Php {{user[3]}}</h3></div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col">
                                <div @click="switchToCard(1)"class="rows text-center align-center py-4 bg-primary"><h3>Go back to Menu</h3></div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card"  v-else-if="cardwindow===3">
                     <div class="card-heading text-center"><h1><strong>Deposit</strong></h1></div>
                     <div class="card-header"><h5>Input amount then click submit button</h5></div>
                     <div class="card-body">
                         <div class="row">
                             <div class="col">
                                <form action="deposit" @submit.prevent="deposit" method="POST">
                                    <div class="row">
                                        <div class="col">
                                            <input v-model="input_amount"class="form-control"type="number" placeholder="Amount to deposit" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input class="btn btn-primary my-5"type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col">
                                <div @click="switchToCard(1)"class="rows text-center align-center py-4 bg-primary"><h3>Go back to Menu</h3></div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card" v-else-if="cardwindow===4">
                     <div class="card-heading text-center"><h1><strong>Withdraw</strong></h1></div>
                     <div class="card-header"><h5>Input amount then click submit button</h5></div>
                     <div class="card-body">
                     <div class="row">
                             <div class="col">
                                <form action="withdraw" @submit.prevent="withdraw" method="POST">
                                    <div class="row">
                                        <div class="col">
                                            <input v-model="input_amount" class="form-control"type="number" placeholder="withdraw amount" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input class="btn btn-primary my-5"type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col">
                                <div @click="switchToCard(1)"class="rows text-center align-center py-4 bg-primary"><h3>Go back to Menu</h3></div>
                             </div>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
        
<?php endblock() ?>  