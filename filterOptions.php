<?php
//**************************** */
// FILTER OPTIONS PANEL
//**************************** */
        echo '<div class="card mb-3">
                <h4 class="card-header">
                    Filter Options
                </h4>
                
                <form class="card-body">
                    <div class="form-group">
                        <span class="card-subtitle">Title:</span>

                        <div class="col-sm-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="searchType" id="searchContains" value="contains" '.(($searchType == "contains") ? "checked" : "").'>
                                <label class="form-check-label mr-5" for="searchContains">
                                    Contains
                                </label>
                                <input class="form-check-input" type="radio" name="searchType" id="searchExact" value="exact" '.(($searchType == "exact") ? "checked" : "").'>
                                <label class="form-check-label" for="searchExact">
                                    Exact Match
                                </label>
                                <label class="col-form-label col-sm-3 text-muted"></label>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="col-sm-12">
                                    <input class="form-control" type="text" value="'.$searchTitle.'" name="title"/>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <span class="card-subtitle">Release Date:</span>
                        <div class="input-group mb-2">
                            <label class="col-form-label col-sm-3 text-muted">From</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" name="yfrom" min="0" max="9999" value="'.$yfrom.'"/>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="col-form-label col-sm-3 text-muted">To</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" name="yto" min="0" max="9999" value="'.$yto.'"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="card-subtitle">Ratings:</span>
                        <div class="input-group mb-2">
                            <label class="col-form-label col-sm-3 text-muted">Min</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" min="0" name="ratingfrom" max="5" value="'.$ratingfrom.'"/>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="col-form-label col-sm-3 text-muted">Max</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" min="0" name="ratingto" max="5" value="'.$ratingto.'"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="card-subtitle">Note:</span>
                        <div class="input-group">
                            <div class="col-sm-12">
                                <input class="form-control" type="text" name="note" value="'.$searchNote.'"/>
                            </div>
                        </div>
                    </div>

                    <a href="index.php" class="btn btn-outline-secondary">Reset</a>
                    <button type="submit" class="btn btn-secondary pull-right">Filter</button>
                </form>
                </div>'; ?>