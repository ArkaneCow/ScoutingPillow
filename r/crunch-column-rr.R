args <- commandArgs(trailingOnly = TRUE)
data_input <- args[1]
img_output <- args[2]
png(img_output)
data <- read.csv(data_input, header=TRUE)
data_fields = data[,1]
data_values = data[,2]

res_lm <- lm(as.formula(paste(colnames(data)[2], "~ c(1:length(data_values))")), data=data)
res_coeffs <- coefficients(res_lm)
next_x = length(data_values) + 1
res <- res_coeffs[1] + res_coeffs[2]*next_x

data_plot <- append(data_values, res)
plot(data_plot, type="n", axes=FALSE, ann=FALSE, col="black")
text(c(1:length(data_plot)), data_plot, round(data_plot, 2), cex=0.9)
lines(data_values, type="l", pch=22, col="black")
axis(1, at=1:length(data_values), lab=c(paste(data_fields)))
axis(2, at=ceiling((range(data_plot)[2] - range(data_plot)[1])/8)*0:range(data_plot)[2])
title(xlab=colnames(data)[1])
title(ylab=colnames(data)[2])
abline(res_lm, col="blue")
data_extend = c(length(data_values), length(data_values) + 1)
data_predict = c(data_values[length(data_values)], res)
lines(data_extend, data_predict, type="l", lty=2, lwd=2, pch=22, col="red")
data_summary = summary(data_values)
text(length(data_values), mean(data_values), mean(data_summary), cex=0.8)
abline(h=mean(data_summary), col="green")
box()

dev.off()

