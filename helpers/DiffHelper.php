<?php

/**
 * DiffHelper
 *
 * @project Cocode
 * @author James Socol
 * @copyright 2009
 */

class DiffHelper
{
	
	public static function diff( $f1 , $f2 , $show_equal = 0 )
    {

        $c1         = 0 ;                   # current line of left
        $c2         = 0 ;                   # current line of right
        $max1       = count( $f1 ) ;        # maximal lines of left
        $max2       = count( $f2 ) ;        # maximal lines of right
        $outcount   = 0;                    # output counter
        $hit1       = "" ;                  # hit in left
        $hit2       = "" ;                  # hit in right

        while ( 
                $c1 < $max1                 # have next line in left
                and                 
                $c2 < $max2                 # have next line in right
                and 
                ($stop++) < 1000            # don-t have more then 1000 ( loop-stopper )
                and 
                $outcount < 20              # output count is less then 20
              )
        {
            /**
            *   is the trimmed line of the current left and current right line
            *   the same ? then this is a hit (no difference)
            */  
            if ( trim( $f1[$c1] ) == trim ( $f2[$c2])  )    
            {
                /**
                *   add to output-string, if "show_equal" is enabled
                */
                $out    .= ($show_equal==1) 
                         ?  formatline ( ($c1) , ($c2), "=", $f1[ $c1 ] ) 
                         : "" ;
                /**
                *   increase the out-putcounter, if "show_equal" is enabled
                *   this ist more for demonstration purpose
                */
                if ( $show_equal == 1 )  
                { 
                    $outcount++ ; 
                }
                
                /**
                *   move the current-pointer in the left and right side
                */
                $c1 ++;
                $c2 ++;
            }

            /**
            *   the current lines are different so we search in parallel
            *   on each side for the next matching pair, we walk on both 
            *   sided at the same time comparing with the current-lines
            *   this should be most probable to find the next matching pair
            *   we only search in a distance of 10 lines, because then it
            *   is not the same function most of the time. other algos
            *   would be very complicated, to detect 'real' block movements.
            */
            else
            {
                
                $b      = "" ;
                $s1     = 0  ;      # search on left
                $s2     = 0  ;      # search on right
                $found  = 0  ;      # flag, found a matching pair
                $b1     = "" ;      
                $b2     = "" ;
                $fstop  = 0  ;      # distance of maximum search

                #fast search in on both sides for next match.
                while ( 
                        $found == 0             # search until we find a pair
                        and 
                        ( $c1 + $s1 <= $max1 )  # and we are inside of the left lines
                        and 
                        ( $c2 + $s2 <= $max2 )  # and we are inside of the right lines
                        and     
                        $fstop++  < 10          # and the distance is lower than 10 lines
                      )
                {

                    /**
                    *   test the left side for a hit
                    *
                    *   comparing current line with the searching line on the left
                    *   b1 is a buffer, which collects the line which not match, to 
                    *   show the differences later, if one line hits, this buffer will
                    *   be used, else it will be discarded later
                    */
                    #hit
                    if ( trim( $f1[$c1+$s1] ) == trim( $f2[$c2] )  )
                    {
                        $found  = 1   ;     # set flag to stop further search
                        $s2     = 0   ;     # reset right side search-pointer
                        $c2--         ;     # move back the current right, so next loop hits
                        $b      = $b1 ;     # set b=output (b)uffer
                    }
                    #no hit: move on
                    else
                    {
                        /**
                        *   prevent finding a line again, which would show wrong results
                        *
                        *   add the current line to leftbuffer, if this will be the hit
                        */
                        if ( $hit1[ ($c1 + $s1) . "_" . ($c2) ] != 1 )
                        {   
                            /**
                            *   add current search-line to diffence-buffer
                            */
                            $b1  .= self::formatline( ($c1 + $s1) , ($c2), "-", $f1[ $c1+$s1 ] );

                            /**
                            *   mark this line as 'searched' to prevent doubles. 
                            */
                            $hit1[ ($c1 + $s1) . "_" . $c2 ] = 1 ;
                        }
                    }



                    /**
                    *   test the right side for a hit
                    *
                    *   comparing current line with the searching line on the right
                    */
                    if ( trim ( $f1[$c1] ) == trim ( $f2[$c2+$s2])  )
                    {
                        $found  = 1   ;     # flag to stop search
                        $s1     = 0   ;     # reset pointer for search
                        $c1--         ;     # move current line back, so we hit next loop
                        $b      = $b2 ;     # get the buffered difference
                    }
                    else
                    {   
                        /**
                        *   prevent to find line again
                        */
                        if ( $hit2[ ($c1) . "_" . ( $c2 + $s2) ] != 1 )
                        {
                            /**
                            *   add current searchline to buffer
                            */
                            $b2   .= self::formatline ( ($c1) , ($c2 + $s2), "+", $f2[ $c2+$s2 ] );

                            /**
                            *   mark current line to prevent double-hits
                            */
                            $hit2[ ($c1) . "_" . ($c2 + $s2) ] = 1;
                        }

                     }

                    /**
                    *   search in bigger distance
                    *
                    *   increase the search-pointers (satelites) and try again
                    */
                    $s1++ ;     # increase left  search-pointer
                    $s2++ ;     # increase right search-pointer  
                }

                /**
                *   add line as different on both arrays (no match found)
                */
                if ( $found == 0 )
                {
                    $b  .= self::formatline ( ($c1) , ($c2), "-", $f1[ $c1 ] );
                    $b  .= self::formatline ( ($c1) , ($c2), "+", $f2[ $c2 ] );
                }

                /** 
                *   add current buffer to outputstring
                */
                $out        .= $b;
                $outcount++ ;       #increase outcounter

                $c1++  ;    #move currentline forward
                $c2++  ;    #move currentline forward

                /**
                *   comment the lines are tested quite fast, because 
                *   the current line always moves forward
                */

            } /*endif*/

        }/*endwhile*/

        return $out;

    }/*end func*/

    /**
    *   callback function to format the diffence-lines with your 'style'
    */
    protected static function formatline( $nr1, $nr2, $stat, &$value )  #change to $value if problems
    {
        if ( trim( $value ) == "" )
        {
            return "";
        }

        switch ( $stat )
        {
            case "=":
                return $nr1. " : $nr2 : = ".htmlentities( $value )  ."<br>";
            break;

            case "+":
                return $nr1. " : $nr2 : + <font color='blue' >".htmlentities( $value )  ."</font><br>";
            break;

            case "-":
                return $nr1. " : $nr2 : - <font color='red' >".htmlentities( $value )  ."</font><br>";
            break;
        }

    } 
	
}